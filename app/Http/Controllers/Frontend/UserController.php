<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RatingComment;
use App\Model\User;
use App\Model\Image;
use App\Model\Reservation;
use App\Http\Requests\Frontend\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Display a page update userprofile.
     *
     * @param int $id of reservation
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->id == $id) {
            $user = User::findOrFail($id);
            return view('frontend.users.updateProfile', compact('user'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update user profile.
     *
     * @param \Illuminate\Http\UpdateRequest $request request to update
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
        if ($request->hasFile('image')) {
            foreach ($user->images as $value) {
                $value->delete();
            }
            $imageName = config('image.name_prefix') . "-" . $request->image->hashName();
            $request->file('image')
                ->move(config('image.users.path_upload'), $imageName);
            Image::create([
                'target' => 'user',
                'target_id' => $user->id,
                'path' => $imageName
                ]);
        }
        if ($user->update($input)) {
            DB::commit();
            flash(__('Update Profile Success!'))->success();
            return redirect()->route('user.profile', $id);
        } else {
            DB::rollback();
            flash(__('Update Profile Failure!'))->error();
            return redirect()->back()->withInput();
        }
    }
}
