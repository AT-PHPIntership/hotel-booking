<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Reservation;
use App\Model\User;
use App\Model\Room;
use App\Model\Guest;
use App\Http\Requests\Frontend\AddReservationRequest;

class ReservationController extends Controller
{
    /**
     * Display form for fill in booking.
     *
     * @param Request $request of rooms id
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    	$bookingInfomation = \Cache::get(User::KEY_CACHE, User::DEFAULT_VALUE);
        $columns = [
            'id',
            'name',
            'descript',
            'price',
            'size',
            'total',
            'max_guest',
            'hotel_id'
        ];
        $room = Room::select($columns)->findOrFail($request->id);
        // dd($bookingInfomation);
        return view('frontend.booking.index', compact('bookingInfomation', 'room'));
    }

    /**
     * Save creating reservation
     *
     * @param AddReservationRequest $request Request create
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddReservationRequest $request)
    {
        $reservation = new Reservation($request->all());

        if($reservation->target == Reservation::TARGET_USER) {
            $result = $reservation->save();
        }
        else {
            $guest = new Guest($request->all());
            $guest->save();
            $reservation->target_id = $guest->id;
            $result = $reservation->save();
        }

        if ($result) {
            return redirect()->route('home.index');
        } else {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display a page update a booking room.
     *
     * @param \Illuminate\Http\Request $request of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $reservationId = $request->route('reservation');
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
     * @param int $id            id of user.
     * @param int $reservationId id of reservation.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId)->update(['status' => Reservation::STATUS_CANCELED]);
        if ($reservation) {
            flash(__('This booking room was canceled!'))->success();
        } else {
            flash(__('Error when cancel this booking room!'))->error();
        }
        return redirect()->route('user.showBooking', [$id, $reservationId]);
    }
}
