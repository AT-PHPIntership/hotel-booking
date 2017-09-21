<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\RatingCommentRequest;
use App\Model\Hotel;
use App\Model\RatingComment;
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
        $id = $request->comment_id;
        $comment = RatingComment::updateOrCreate(['id' => $id], $request->all());
        if ($id && $comment->save()) {
            flash(__('You was edit comment successfully !'))->success();
            return redirect(URL::previous() . config('hotel.section_rating_comment'));
        } elseif (!$id && $comment->save()) {
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

    /**
     * Get data rating comment and response to json
     *
     * @param int $id id of rating comment
     *
     * @return json
     */
    public function show($id)
    {
        $comment = RatingComment::findOrFail($id);
        return response()->json(['data' => $comment], 200);
    }
}
