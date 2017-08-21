<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Reservation;
use App\Model\User;
use App\Model\Guest;

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
            'checkin_date',
            'checkout_date'
        ];
        $reservations = Reservation::select($columns)
                    ->with(['bookingroom' => function($query){
                    	$query->select('id','name');
                    }])
                    ->orderby('id', 'DESC')
                    ->paginate(Reservation::ROW_LIMIT);
        return view('backend.bookings.index', compact('reservations'));
    }

    /**
     * Display a page show detail a booking rooms.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = [
            'id',
            'status',
            'room_id',
            'target',
            'target_id',
            'quantity',
            'checkin_date',
            'checkout_date',
            'request'
        ];
        $reservation = Reservation::select($columns)
                    ->with(['bookingroom' => function($query){
                        $query->select('id', 'name');
                    }])
                    ->findOrFail($id);
        if($reservation->target == 'user') {
            $user = User::select('full_name', 'email', 'phone')
                        ->where('id', $reservation->target_id)
                        ->firstOrFail();
        } else {
            $user = Guest::select('full_name', 'email', 'phone')
                        ->where('id', $reservation->target_id)
                        ->firstOrFail();
        }
        return view('backend.bookings.show', compact('reservation', 'user'));
    }
}
