<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\UpdateReservationRequest;
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
            'id',
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
            'id',
            'status',
            'room_id',
            'target',
            'target_id',
            'checkin_date',
            'checkout_date',
            'quantity',
            'request'
        ];
        $with['room'] = function ($query) {
            $query->select('rooms.id', 'rooms.name', 'rooms.hotel_id');
        };
        $with['reservable'] = function ($query) {
            $query->select('full_name', 'phone', 'email');
        };
        $with['room.hotel'] = function ($query) {
            $query->select('hotels.id', 'hotels.name');
        };
        $reservation = Reservation::select($columns)->with($with)->findOrFail($id);
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
            'target',
            'target_id',
            'checkin_date',
            'checkout_date',
            'quantity',
            'request'
        ];
        $with['room'] = function ($query) {
            $query->select('rooms.id', 'rooms.name', 'rooms.hotel_id');
        };
        $with['reservable'] = function ($query) {
            $query->select('full_name', 'phone', 'email');
        };
        $with['room.hotel'] = function ($query) {
            $query->select('hotels.id', 'hotels.name');
        };
        $reservation = Reservation::select($columns)->with($with)->findOrFail($id);
        return view('backend.bookings.edit', compact('reservation'));
    }

    /**
     * Update status of a booking room.
     *
     * @param \App\Http\Requests\UpdateReservationRequest $request of form update Booking room
     * @param int                                         $id      of Reservation
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationRequest $request, $id)
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
