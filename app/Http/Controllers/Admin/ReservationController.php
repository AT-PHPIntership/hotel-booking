<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Reservation;
use App\Model\User;
use App\Model\Guest;

class ReservationController extends Controller
{
    /**
     * Display a listing of booking room
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = [
            'reservations.id',
            'status',
            'room_id',
            'target',
            'checkin_date',
            'checkout_date'
        ];
        $reservations = Reservation::select($columns)
                    ->with(['bookingroom' => function ($query) {
                        $query->select('rooms.id', 'name');
                    }])
                    ->orderby('reservations.id', 'DESC')
                    ->paginate(Reservation::ROW_LIMIT);
        return view('backend.bookings.index', compact('reservations'));
    }
}
