<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Reservation;
use App\Model\User;
use App\Model\Guest;
use App\Model\Room;
use App\Model\Hotel;

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

    /**
     * Display a page show detail a booking rooms.
     *
     * @param int $id of reservation
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = [
            'reservations.id',
            'status',
            'room_id',
            'target',
            'target_id',
            'checkin_date',
            'checkout_date',
            'quantity',
            'request'
        ];
        $reservation = Reservation::select($columns)
            ->with(['room' => function ($query) {
                $query->select('rooms.id', 'rooms.name', 'rooms.hotel_id');
            }, 'reservable', 'room.hotel'])
            ->findOrFail($id);
        return view('backend.bookings.show', compact('reservation'));
    }

    /**
     * Display a page update status booking room.
     *
     * @param int $id of reservation
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $columns = [
            'id',
            'status',
            'room_id',
            'checkin_date',
            'checkout_date'
        ];
        $reservation = Reservation::select($columns)
                    ->with(['room' => function ($query) {
                        $query->select('rooms.id', 'name');
                    }])
                    ->findOrFail($id);        
        $status = Reservation::select('status')
            ->groupby('status')
            ->having('status', '<>', Reservation::STATUS_CANCELED)
            ->get();
        return view('backend.bookings.edit', compact('reservation', 'status'));
    }

    /**
     * Update information of a News
     *
     * @param \App\Http\Requests\ $request of form Edit Booking
     * @param int                                $id      of News
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $reservationUpdate = Reservation::findOrFail($id)->update($request->all());
        if ($reservationUpdate) {
            flash(__('Edit Booking Room Success!'))->success();
            return redirect()->route('reservation.index');
        } else {
            flash(__('Edit Booking Room Fail!'))->error();
            return redirect()->route('reservation.edit');
        }
    }
}
