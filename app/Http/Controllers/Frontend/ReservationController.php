<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Reservation;
use App\Model\User;
use App\Model\Room;
use App\Model\Guest;
use Carbon\Carbon;
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
        $emptyRooms = $room->total;

        if (isset($bookingInfomation)) {
            $checkinDate = Carbon::createFromFormat(config('hotel.datetime_format'), $bookingInfomation['checkin'] . config('hotel.checkin_time'))
                ->toDateTimeString();
            $emptyRooms = $this->totalEmptyRoom($room->id, $checkinDate);
        }

        return view('frontend.booking.index', compact('bookingInfomation', 'room', 'emptyRooms'));
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

        $checkinDate = Carbon::createFromFormat(config('hotel.datetime_format'), $request->checkin . config('hotel.checkin_time'))
                ->toDateTimeString();
        $checkoutDate = Carbon::createFromFormat(config('hotel.datetime_format'), $request->checkin . config('hotel.checkout_time'))
                ->addDay($request->duration)
                ->toDateTimeString();
        // set date for reservation
        $reservation->checkin_date = $checkinDate;
        $reservation->checkout_date = $checkoutDate;
        // get quanlity empty room
        $emptyRooms = $this->totalEmptyRoom($request->room_id, $checkinDate);
        // return fail when room not enough
        if ($reservation->quantity > $emptyRooms) {
            flash(__('Sorry! The room is not enough!'))->error();
            return redirect()->back()->withInput();
        }
        // save booking infomation
        if ($reservation->target == Reservation::TARGET_USER) {
            $result = $reservation->save();
        } else {
            $guest = Guest::where('email', $request->email)->first();
            if (!$guest) {
                $guest = new Guest($request->all());
                $guest->save();
            }
            $reservation->target_id = $guest->id;
            $result = $reservation->save();
        }

        if ($result) {
            flash(__('Booking success! Thank you!'))->success();
            return redirect()->back();
        } else {
            flash(__('Booking failure! Sorry'))->error();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Save creating reservation
     *
     * @param int      $roomId  id       of room
     * @param datetime $checkin datetime checkin
     *
     * @return \Illuminate\Http\Response
     */
    public function totalEmptyRoom($roomId, $checkin)
    {
        $room = Room::findOrFail($roomId);
        $roomBusy = $room->reservations()
            ->where([
                ['status', '1'],
                ['checkin_date', '<=', $checkin],
                ['checkout_date', '>=', $checkin]
                ])
            ->get();
            $totalBusy = $roomBusy->sum('quantity');
        return $room->total - $totalBusy;
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
