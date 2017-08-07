<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RatingComment;
use App\Model\User;
use App\Model\Hotel;

class RatingCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratingComments = RatingComment::
            select('id', 'user_id', 'hotel_id', 'total_rating', 'created_at')
            ->with(['users' => function ($query) {
                $query->addSelect('id', 'username', 'full_name');
            }])
            ->with(['hotels' => function ($query) {
                $query->addSelect('id', 'name');
            }])
            ->orderby('id', 'DESC')->paginate(10);

        // dd($ratingComments);
        return view('backend.comments.index', compact('ratingComments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id of comment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = RatingComment::findOrFail($id)->delete();

        if ($result) {
            flash('Deletion successful')->success();
        } else {
            flash('Deletion failed')->error();
        }
        return redirect()->route('comment.index');
    }
}
