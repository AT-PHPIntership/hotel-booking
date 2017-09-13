<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Reservation;

class ReservationController extends Controller
{
    /**
     * Display a page update a booking room.
     *
     * @param int $idUser        id of user.
     * @param int $reservationId id of reservation.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($idUser, $reservationId)
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
        $reservation = Reservation::select($columns)->with($with)->findOrFail($reservationId);
        return view('frontend.users.editHistory', compact('reservation'));
    }

    /**
     * Cancel a reservation of user.
     *
     * @param int $idUser        id of user.
     * @param int $reservationId id of reservation.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($idUser, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId)->update(['status' => Reservation::STATUS_CANCELED]);
        if ($reservation) {
            flash(__('This booking room was canceled!'))->success();
        } else {
            flash(__('Error when cancel this booking room!'))->error();
        }
        return redirect()->route('user.showBooking', [$idUser, $reservationId]);
    }
}
