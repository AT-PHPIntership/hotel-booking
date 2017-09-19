<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hotel;
use App\Model\Image;
use App\Model\Room;
use App\Model\Place;
use App\Model\Reservation;
use App\Model\RatingComment;
use App\Model\User;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Response;
use App\Http\Requests\Frontend\SearchHotelRequest;

class HotelController extends Controller
{
    /**
     * Show hotel
     *
     * @param string  $slug    slug of hotel
     * @param Request $request request of user in browser
     *
     * @return void
     */
    public function show($slug, Request $request)
    {
        $checkoutDateDefault = Carbon::tomorrow()->addWeeks(Hotel::WEEK_NUMBER);
        $checkinDateDefault = $checkoutDateDefault->toDateTimeString();
        $checkoutDateDefault->addDay()->toDateTimeString();

        if ($request->has('checkin')) {
            $checkinDateDefault = Carbon::createFromFormat(config('hotel.datetime_format'), $request->checkin . config('hotel.checkin_time'))
                ->toDateTimeString();
            $checkoutDateDefault = Carbon::createFromFormat(config('hotel.datetime_format'), $request->checkin . config('hotel.checkout_time'))
                ->addDay($request->duration)
                ->toDateTimeString();
        }

        $columns = [
            'hotels.id',
            'name',
            'address',
            'star',
            'introduce',
            'place_id'
        ];
        $commentColumns = [
            'food',
            'cleanliness',
            'comfort',
            'location',
            'service',
            'comment',
            'total_rating',
            'hotel_id',
            'user_id',
            'created_at',
        ];
        $hotelId = Hotel::where('slug', $slug)->firstOrFail()->id;
        $with['images'] = function ($query) {
            $query->select();
        };

        $joinQuery = <<<EOD
            (
                SELECT busy_reservations.room_id as room_id, SUM(busy_reservations.quantity) as quantity_busy_reservation
                FROM (
                    SELECT * FROM reservations 
                    WHERE (status = ?) AND ((checkin_date < ? AND checkout_date > ?)
                        OR (checkin_date < ? AND checkout_date > ?))
                ) AS busy_reservations 
                GROUP BY busy_reservations.room_id
            ) AS busy_rooms
EOD;

        $roomEmpty = Room::where('hotel_id', $hotelId)
            ->leftJoin(DB::raw($joinQuery), 'busy_rooms.room_id', '=', 'rooms.id')
            ->addBinding([
                Reservation::STATUS_ACCEPTED,
                $checkinDateDefault,
                $checkinDateDefault,
                $checkoutDateDefault,
                $checkoutDateDefault
            ], 'join')
            ->orderBy('price', 'ASC')->get();
        $ratingComments = RatingComment::select($commentColumns)
            ->with('user')
            ->where('hotel_id', $hotelId)->orderBy('created_at', 'DESC')
            ->paginate(Hotel::COMMENT_ROW_LIMIT);
   
        $hotel = Hotel::select($columns)->with($with)
            ->where('slug', $slug)
            ->firstOrFail();
        $services = $hotel->services()->get();
       
        return view('frontend.hotels.show', compact('hotel', 'ratingComments', 'roomEmpty', 'services', 'checkinDateDefault', 'checkoutDateDefault'));
    }

    /**
     * Display a listing of the resource.
     *
     *@param SearchHotelRequest $request request to display
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchHotelRequest $request)
    {
        if (\Cache::has(User::KEY_CACHE)) {
            \Cache::forget(User::KEY_CACHE);
        }
        \Cache::put(User::KEY_CACHE, $request->all(), User::TIMEOUT_CACHE);
        
        $columns = [
            'hotels.id',
            'hotels.slug',
            'hotels.name',
            'address',
            'star',
            'place_id',
            'hotels.created_at'
        ];
        $hotels = Hotel::select($columns)
            ->with(['hotelServices' => function ($query) {
                $query->join('services', 'hotel_services.service_id', '=', 'services.id');
            }])
            ->placeCondition($request)
            ->orderCondition($request)
            ->checkinCondition($request, $columns)
            ->orderby('hotels.id', 'DESC')
            ->paginate(Hotel::ITEM_LIMIT);
        // Top 7 place booked most within the last month
        $hintedPlaces = Place::topPlaces();
        return view('frontend.hotels.index', compact('hotels', 'hintedPlaces'));
    }
}
