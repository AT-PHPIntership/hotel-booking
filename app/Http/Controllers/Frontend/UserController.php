<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RatingComment;
use App\Model\User;
use App\Model\Reservation;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->id == $id) {
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
            return view('frontend.users.showProfile', compact('user', 'comments', 'reservations'));
        } else {
            return redirect()->back();
        }
    }
}
