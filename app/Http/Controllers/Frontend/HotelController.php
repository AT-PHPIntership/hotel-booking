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

class HotelController extends Controller
{
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

        $hotels = Hotel::search()
            ->select($columns)
            ->with(['hotelServices' => function ($query) {
                $query->join('services', 'hotel_services.service_id', '=', 'services.id');
            }])
            ->orderby('hotels.id', 'DESC')
            ->paginate(Hotel::ITEM_LIMIT)
            ->appends(['search' => request('search')]);
        $topPlaces = \DB::table('places')->select('places.id', 'places.name', \DB::raw("SUM(quantityReservations) AS totalQuantity"))
                        ->leftJoin('hotels', 'hotels.place_id', '=', 'places.id')
                        ->leftJoin('rooms', 'rooms.hotel_id', '=', 'hotels.id')
                        ->leftJoin(\DB::raw('(SELECT reservations.room_id , SUM(quantity) as quantityReservations FROM reservations where reservations.created_at <= DATE_SUB(NOW(),INTERVAL -30 DAY) GROUP BY reservations.room_id) AS reservation_of_rooms'), 'rooms.id', '=', 'reservation_of_rooms.room_id')->groupBy('places.id')->orderby('totalQuantity', 'DESC')
                        ->limit(5)
                        ->get();
        return view('frontend.hotels.index', compact('hotels', 'topPlaces'));
    }
}
