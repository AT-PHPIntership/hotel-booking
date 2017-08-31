<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbackField = [
            'id',
            'full_name',
            'email',
            'content'
        ];
        $feedbacks = Feedback::select($feedbackField)
            ->orderBy('id', 'DESC')
            ->paginate(Feedback::ROW_LIMIT);
        return view("backend.feedbacks.index", compact('feedbacks'));
    }

    /**
     * Find feedback by id and delete feedback
     *
     * @param int $id id feedback
     *
     * @return void
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        if ($feedback->delete()) {
            flash(__('Delete success'))->success();
        } else {
            flash(__('Delete failure'))->error();
        }
        return redirect()->route('feedback.index');
    }

    /**
     * Show feedback detail
     *
     * @param int $id id feedback
     *
     * @return void
     */
    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('backend.feedbacks.show', compact('feedback'));
    }
}
