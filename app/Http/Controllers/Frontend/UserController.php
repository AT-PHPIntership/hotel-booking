<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RatingComment;
use App\Model\User;
use App\Model\Reservation;

class UserController extends Controller
{
    /**
     * Display page show profile user.
     *
     * @param int $id id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $colComment = [
            'id',
            'hotel_id',
            'comment',
            'total_rating',
            'created_at'
        ];
        $colReservation = [
            'id',
            'room_id',
            'checkin_date',
            'checkout_date',
            'status'
        ];
        $comments = RatingComment::select($colComment)
            ->with(['hotel' => function ($query) {
                $query->select('id', 'name');
            }])
            ->where('user_id', $id)
            ->orderby('id', 'DESC')
            ->paginate(USER::ROW_LIMIT);
        $reservations = Reservation::select($colReservation)->with(['room' => function ($query) {
            $query->select('id', 'name');
        }])->where([
            ['target', 'user'],
            ['target_id', $id],
        ])
        ->orderby('id', 'DESC')->paginate(User::ROW_LIMIT);
        return view('frontend.users.show', compact('user', 'comments', 'reservations'));
    }
}