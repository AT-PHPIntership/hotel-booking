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
        $hotels = Hotel::select($columns)
            ->with(['hotelServices' => function ($query) {
                $query->join('services', 'hotel_services.service_id', '=', 'services.id');
            }]);

        if ($request->has('hotelSourceArea')) {
            /**
             * Hotel belong to searched place
             */
            $hotels = $hotels->whereIn("hotels.place_id", function ($query) use ($request) {
                $query->select('id')
                    ->from('places')
                    ->Where("name", "LIKE", "%$request->hotelSourceArea%");
            });
        }

        if ($request->has('arange_id') && $request->arange_id != 0) {
            /**
             * Arange hotel
             */
            if ($request->arange_id <= 2) {
                /**
                 * Arange hotel by price rooms in hotel
                 */
                if ($request->arange_id % 2 == 0) {
                    /**
                     * Arange hotel by most expensive room in hotels order by decrease
                     */
                    $hotels = $hotels->join(\DB::raw("(SELECT hotel_id, max(price) AS max_price_room FROM rooms group by hotel_id) AS most_expensive_rooms"), 'most_expensive_rooms.hotel_id', '=', 'hotels.id')
                    ->orderby('max_price_room', 'DESC');
                } else {
                    /**
                     * Arange hotel by most cheap room in hotels order by increase
                     */
                    $hotels = $hotels->join(\DB::raw("(SELECT hotel_id, min(price) AS min_price_room FROM rooms group by hotel_id) AS most_cheap_rooms"), 'most_cheap_rooms.hotel_id', '=', 'hotels.id')
                    ->orderby('min_price_room', 'ASC');
                }
            } elseif ($request->arange_id <= 4) {
                /**
                 * Arange hotel by star of hotel
                 */
                $hotels = $hotels->orderby('star', ($request->arange_id % 2) == 0 ? 'DESC' : 'ASC');
            } else {
                /**
                 * Arange hotel by average rating of hotel order by decrease
                 */
                $hotels = $hotels->join(\DB::raw("(SELECT hotel_id, avg(total_rating) AS avg_rating FROM rating_comments group by hotel_id) AS summary_ratings"), 'summary_ratings.hotel_id', '=', 'hotels.id')
                    ->orderby('avg_rating', 'DESC');
            }
        }
        if ($request->has('checkin')) {
            $checkout = Carbon::createFromFormat('d/m/Y H:i:s', $request->checkin." 00:00:00");

            $checkin = $checkout->toDateTimeString();

            $checkout->addDay($request->duration)->toDateTimeString();

            /**
             * Hotel have blank room from checkin day to checkout day
             */
            $hotels= $hotels->join('rooms', 'rooms.hotel_id', '=', 'hotels.id')
                ->leftJoin(\DB::raw("(SELECT busy_reservations.room_id as room_id, SUM(busy_reservations.quantity) as quantity_busy_reservation FROM (SELECT * FROM reservations WHERE (checkin_date < '$checkin' AND checkout_date > '$checkin') OR (checkin_date < '$checkout' AND checkout_date > '$checkout')) AS busy_reservations GROUP BY busy_reservations.room_id)  AS busy_rooms"), 'busy_rooms.room_id', '=', 'rooms.id')
                ->where(\DB::raw('COALESCE(quantity_busy_reservation,0)'), '<', \DB::raw('CONVERT(total, CHAR(5))'))
                ->select(array_merge($columns, [\DB::raw("COUNT(rooms.id) AS quantity_kind_blank_room")]))
                ->groupBy('hotels.id');
        }

        /**
         * Top 7 place booked most within the last month
         */
        $hintedPlaces = Place::topPlaces();

        $hotels = $hotels->orderby('hotels.id', 'DESC')
            ->paginate(Hotel::ITEM_LIMIT);
        return view('frontend.hotels.index', compact('hotels', 'hintedPlaces'));
    }
}
