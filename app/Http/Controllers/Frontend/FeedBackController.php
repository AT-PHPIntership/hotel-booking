<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\FeedbackRequest;
use App\Model\Feedback;

class FeedBackController extends Controller
{
    /**
     * Create feedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.feedbacks.index');
    }

    /**
     * Store a newly feedback in storage.
     *
     * @param \Illuminate\Http\CreateNewsRequest $request of form creat News
     *
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequest $request)
    {
        $feedback = new Feedback($request->all());
        $result = $feedback->save();
        if ($result) {
            flash(__('Sent Feedback!'))->success();
        } else {
            flash(__('Error when send feedback!'))->error();
        }
        return redirect()->route('feedback');
    }
}
