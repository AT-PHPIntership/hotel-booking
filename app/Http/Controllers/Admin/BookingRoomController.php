<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Reservation;

class BookingRoomController extends Controller
{
    /**
     * Display a listing of booking room
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = [
            'id',
            'status',
            'room_id',
            'target',
            'quantity',
            'checkin_date',
            'checkout_date',
            'request'
        ];
        $reservations = Reservation::select($columns)
                    ->with(['bookingroom' => function($query){
                    	$query->select('id','name');
                    }])
                    ->paginate(Reservation::ROW_LIMIT);
        return view('backend.bookings.index', compact('reservations'));
    }

    /**
     * Display a page show detail a booking rooms.
     *
     * @return \Illuminate\Http\Response
     */
    public function show() {
        return view('backend.bookings.show');
    }
}
