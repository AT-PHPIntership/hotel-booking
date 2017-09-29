<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RatingComment;
use App\Model\User;
use App\Model\Image;
use App\Model\Reservation;
use App\Http\Requests\Frontend\UpdateProfileRequest;
use Illuminate\Support\Facades\DB;

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
                $query->select('id', 'name', 'slug');
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

    /**
     * Display a page update userprofile.
     *
     * @param int $id of reservation
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.users.updateProfile', compact('user'));
    }

    /**
     * Update user profile.
     *
     * @param \Illuminate\Http\UpdateRequest $request request of form update profile
     * @param int                            $id      id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, $id)
    {
        DB::beginTransaction();
        if ($request['password'] == null) {
            unset($request['password']);
        }
        $user = User::findOrFail($id);
        $input = $request->all();
        try {
            if ($request->hasFile('image')) {
                foreach ($user->images as $value) {
                    $value->delete();
                }
                Image::storeImages(array($request->image), 'user', $user->id, config('image.users.path_upload'));
            }
            $user->update($input);
            DB::commit();
            flash(__('Update Profile Success!'))->success();
            return redirect()->route('profile.show', $id);
        } catch (Exception $e) {
            DB::rollback();
            flash(__('Update Profile Failure!'))->error();
            return redirect()->back()->withInput();
        }
    }
}
