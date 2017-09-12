<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Service;
use App\Model\Image;
use App\Model\Room;
use App\Model\HotelService;
use App\Model\Reservation;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\Http\Requests\Frontend\SearchHotelRequest;
use DB;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *@param SearchHotelRequest $request request to display
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchHotelRequest $request)
    {
        $columns = [
            'hotels.id',
            'hotels.name',
            'address',
            'star',
            'place_id',
            'hotels.created_at'
        ];
        $query = Hotel::select($columns)
            ->with(['hotelServices' => function ($query) {
                $query->join('services', 'hotel_services.service_id', '=', 'services.id');
            }]);
        $query = $this->placeCondition($request, $query);
        $query = $this->orderCondition($request, $query);
        $query = $this->checkinCondition($request, $query, $columns);
        $hotels = $query->orderby('hotels.id', 'DESC')
            ->paginate(Hotel::ITEM_LIMIT);
        // Top 7 place booked most within the last month
        $hintedPlaces = Place::topPlaces();
        return view('frontend.hotels.index', compact('hotels', 'hintedPlaces'));
    }

    /**
     * Get query after check place of hotels
     *
     * @param SearchHotelRequest $request request to display
     * @param queryBuilder       $query   query to change
     *
     * @return queryBuilder
     */
    private function placeCondition($request, $query)
    {
        if ($request->has('hotelSourceArea')) {
            // Hotel belong to searched place
            $place = Place::where("name", "$request->hotelSourceArea")->first();
            return $query->where("hotels.place_id", $place->id);
        }
        return $query;
    }

    /**
     * Get query after check arrange of hotels
     *
     * @param SearchHotelRequest $request request to display
     * @param queryBuilder       $query   query to change
     *
     * @return queryBuilder
     */
    private function orderCondition($request, $query)
    {
        if ($request->has('arrange_id')) {
            // Arrange hotel
            switch ($request->arrange_id) {
                case Hotel::PRICE_ASC:
                    // Arrange hotel by most cheap room in hotels order by increase
                    return $query->join(DB::raw("(SELECT hotel_id, min(price) AS min_price_room FROM rooms group by hotel_id) AS most_cheap_rooms"), 'most_cheap_rooms.hotel_id', '=', 'hotels.id')
                                ->orderby('min_price_room', 'ASC');
                case Hotel::PRICE_DESC:
                   // Arrange hotel by most expensive room in hotels order by decrease
                    return $query->join(DB::raw("(SELECT hotel_id, max(price) AS max_price_room FROM rooms group by hotel_id) AS most_expensive_rooms"), 'most_expensive_rooms.hotel_id', '=', 'hotels.id')
                                ->orderby('max_price_room', 'DESC');
                case Hotel::STAR_ASC:
                    // Arrange hotel by star of hotel order by increase
                    return $query->orderby('star', 'ASC');
                case Hotel::STAR_DESC:
                    // Arrange hotel by star of hotel order by increase
                    return $query->orderby('star', 'DESC');
                case Hotel::RATING_DESC:
                    // Arrange hotel by average rating of hotel order by decrease
                    return $query->join(DB::raw("(SELECT hotel_id, avg(total_rating) AS avg_rating FROM rating_comments group by hotel_id) AS summary_ratings"), 'summary_ratings.hotel_id', '=', 'hotels.id')
                                ->orderby('avg_rating', 'DESC');
            }
        }
        return $query;
    }

    /**
     * Get query after check checkin rooms of hotels
     *
     * @param SearchHotelRequest $request request to display
     * @param queryBuilder       $query   query to change
     * @param array              $columns array of columns
     *
     * @return queryBuilder
     */
    private function checkinCondition($request, $query, $columns)
    {
        if ($request->has('checkin')) {
            $checkin = Carbon::createFromFormat(config('showitem.format_datetime'), $request->checkin . " " . config('showitem.checkin_time'))
                        ->toDateTimeString();

            $checkout = Carbon::createFromFormat(config('showitem.format_datetime'), $request->checkin . " " . config('showitem.checkout_time'))
                        ->addDay($request->duration)
                        ->toDateTimeString();
            // Hotel have blank room from checkin day to checkout day
            return $query->join('rooms', 'rooms.hotel_id', '=', 'hotels.id')
                        ->leftJoin(DB::raw("(SELECT room_id, SUM(quantity) as quantity_busy_reservation FROM reservations WHERE (status = ? OR status = ?) AND ((checkin_date < ? AND checkout_date > ?) OR (checkin_date < ? AND checkout_date > ?)) GROUP BY room_id)  AS busy_rooms"), 'busy_rooms.room_id', '=', 'rooms.id')
                        ->addBinding([
                            Reservation::STATUS_ACCEPTED,
                            Reservation::STATUS_PENDING,
                            $checkin,
                            $checkin,
                            $checkout,
                            $checkout
                        ], 'join')
                        ->where(DB::raw('COALESCE(quantity_busy_reservation, 0)'), '<', DB::raw('CONVERT(total, CHAR(5))'))
                        ->select(array_merge($columns, [DB::raw("COUNT(rooms.id) AS quantity_kind_blank_room")]))
                        ->groupBy('hotels.id');
        }
        return $query;
    }
}
