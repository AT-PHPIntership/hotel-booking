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
use Carbon\Carbon;

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
        $checkoutDateDefaut = Carbon::tomorrow('Asia/Bangkok')->addWeeks(Hotel::WEEK_NUMBER);
        $checkinDateDefaut = $checkoutDateDefaut->toDateTimeString();
        $checkoutDateDefaut->addDay();

        if ($request->has('checkin')) {
            $checkinDateDefaut = Carbon::createFromFormat(Hotel::DATETIME_FORMAT, $request->checkin . Hotel::CHECKIN_TIME)
                ->toDateTimeString();
            $checkoutDateDefaut = Carbon::createFromFormat(Hotel::DATETIME_FORMAT, $request->checkin . Hotel::CHECKOUT_TIME)
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
        $roomColumns = [
            'hotel_id',
            'rooms.id',
            'name',
            'max_guest',
            'price',
            'size',
            'total',
            'bed',
            'direction',
            'descript',
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
        $hotel_id = Hotel::where('slug', $slug)->firstOrFail()->id;
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
        $roomEmpty = Room::where('hotel_id', $hotel_id)
            ->leftJoin(\DB::raw("(SELECT busy_reservations.room_id as room_id, SUM(busy_reservations.quantity) as quantity_busy_reservation FROM (SELECT * FROM reservations WHERE (checkin_date < '$checkinDateDefaut' AND checkout_date > '$checkinDateDefaut') OR (checkin_date < '$checkoutDateDefaut' AND checkout_date > '$checkoutDateDefaut')) AS busy_reservations GROUP BY busy_reservations.room_id) AS busy_rooms"), 'busy_rooms.room_id', '=', 'rooms.id', ['checkin' => $checkinDateDefaut, 'checkout' => $checkoutDateDefaut])
            ->where(\DB::raw('COALESCE(quantity_busy_reservation, 0)'), '<', \DB::raw('CONVERT(total, CHAR(5))'))->orderBy('price', 'ASC')
            ->get();
        $ratingComments = RatingComment::select($commentColumns)
            ->where('hotel_id', $hotel_id)->orderBy('created_at', 'DESC')
            ->paginate(Hotel::COMMENT_ROW_LIMIT);
   
        $hotel = Hotel::select($columns)->with($with)->where('slug', $slug)
            ->firstOrFail();
        
        return view('frontend.hotels.show', compact('hotel', 'ratingComments', 'roomEmpty'));
    }
}
