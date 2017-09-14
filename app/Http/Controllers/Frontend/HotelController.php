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
use App\Model\RatingComment;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;

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
        $checkoutDateDefaut = Carbon::tomorrow()->addWeeks(Hotel::WEEK_NUMBER);
        $checkinDateDefaut = $checkoutDateDefaut->toDateTimeString();
        $checkoutDateDefaut->addDay();

        if ($request->has('checkin')) {
            $checkinDateDefaut = Carbon::createFromFormat(config('hotel.datetime_format'), $request->checkin . config('hotel.checkin_time'))
                ->toDateTimeString();
            $checkoutDateDefaut = Carbon::createFromFormat(config('hotel.datetime_format'), $request->checkin . config('hotel.checkout_time'))
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
        $with['place'] = function ($query) {
            $query->select('id', 'name');
        };
        $with['images'] = function ($query) {
            $query->select();
        };
        $with['hotelServices'] = function ($query) {
            $query->select('id', 'hotel_id', 'service_id');
        };
        $with['ratingComments.user'] = function ($query) {
            $query->select('id', 'username');
        };
        $with['hotelServices.service'] = function ($query) {
            $query->select('id', 'name');
        };
        $roomEmpty = Room::where('hotel_id', $hotelId)
            ->leftJoin(DB::raw("(SELECT busy_reservations.room_id as room_id, SUM(busy_reservations.quantity) as quantity_busy_reservation FROM (SELECT * FROM reservations WHERE (checkin_date < ? AND checkout_date > ?) OR (checkin_date < ? AND checkout_date > ?)) AS busy_reservations GROUP BY busy_reservations.room_id) AS busy_rooms"), 'busy_rooms.room_id', '=', 'rooms.id')
            ->addBinding([$checkinDateDefaut, $checkinDateDefaut, $checkoutDateDefaut,  $checkoutDateDefaut], 'join')
            ->where(DB::raw('COALESCE(quantity_busy_reservation, 0)'), '<', DB::raw('CONVERT(total, CHAR(5))'))->orderBy('price', 'ASC')
            ->get();
        $ratingComments = RatingComment::select($commentColumns)
            ->where('hotel_id', $hotelId)->orderBy('created_at', 'DESC')
            ->paginate(Hotel::COMMENT_ROW_LIMIT);
   
        $hotel = Hotel::select($columns)->with($with)->where('slug', $slug)
            ->firstOrFail();
        
        return view('frontend.hotels.show', compact('hotel', 'ratingComments', 'roomEmpty'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
            }])
            ->orderby('hotels.id', 'DESC')
            ->paginate(Hotel::ITEM_LIMIT);
        return view('frontend.hotels.index', compact('hotels'));
    }
}
