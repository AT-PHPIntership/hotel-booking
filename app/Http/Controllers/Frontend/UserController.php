<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RatingComment;
use App\Model\User;

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
        $columns = [
            'id',
            'hotel_id',
            'comment',
            'total_rating',
            'created_at'
        ];
        $comments = RatingComment::select($columns)
            ->with(['hotel' => function ($query) {
                $query->select('id', 'name');
            }])
            ->where('user_id', $id)
            ->orderby('id', 'DESC')
            ->paginate(USER::ROW_LIMIT);
        return view('frontend.users.showProfile', compact('user', 'comments'));
    }
}
