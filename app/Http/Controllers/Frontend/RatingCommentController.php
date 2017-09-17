<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\RatingCommentRequest;
use App\Http\Controllers\Controller;
use App\Model\RatingComment;
use App\Model\Hotel;
use Illuminate\Support\Facades\URL;

class RatingCommentController extends Controller
{
    /**
     * Store rating comment from user on hotel
     *
     * @param RatingCommentRequest $request request validation
     *
     * @return void
     */
    public function store(RatingCommentRequest $request)
    {
        if (RatingComment::create($request->all())) {
            flash(__('You have commented successfully!'))->success();
            return redirect(URL::previous() . config('hotel.section_rating_comment'));
        } else {
            flash(__('You have commented failed!'))->error();
            return redirect(URL::previous() . config('hotel.section_rating_comment'))
                ->withInput();
        }
    }

    /**
     * Find comment by id and delete comment
     *
     * @param int $id id comment
     *
     * @return void
     */
    public function destroy($id)
    {
        $comment = RatingComment::findOrFail($id);
        if ($comment->delete()) {
            flash(__('Delete success'))->success();
        } else {
            flash(__('Delete failure'))->error();
        }

        return redirect(URL::previous() . config('hotel.section_rating_comment'));
    }
}
