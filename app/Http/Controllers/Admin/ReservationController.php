<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Reservation;

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
            'target_id',
            'checkin_date',
            'checkout_date'
        ];
        $reservations = Reservation::select($columns)
                    ->with(['room' => function ($query) {
                        $query->select('rooms.id', 'name');
                    }, 'reservable'])
                    ->orderby('reservations.id', 'DESC')
                    ->paginate(Reservation::ROW_LIMIT);
        return view('backend.bookings.index', compact('reservations'));
    }
}
