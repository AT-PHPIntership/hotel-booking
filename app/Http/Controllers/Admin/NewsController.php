<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;
use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\EditNewsRequest;
use Session;

class NewsController extends Controller
{
    /**
     * Display a listing of news.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::select('id', 'title', 'slug', 'content', 'category_id')
                    ->with(['category' => function ($query) {
                        $query->addSelect('id', 'name');
                    }])
                    ->orderby('id', 'ASC')->paginate(10);
        return view('backend.news.index', compact('news'));
    }

    /**
     * Display form edit a News.
     *
     * @param string $slug of News
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $news = News::where('slug', $slug)
                    ->select('id', 'title', 'content', 'category_id')
                    ->get();
        return view('backend.news.edit', compact('news'));
    }

    /**
     * Update information of a News
     *
     * @param \App\Http\Requests\EditNewsRequest $request of form Edit News
     * @param int                                $id      of News
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EditNewsRequest $request, $id)
    {
        $news = News::findOrFail($id);
        $news->Update($request->all());
        if ($news->update()) {
            flash(__('Edit News Success!'))->success();
            return redirect()->route('news.index');
        } else {
            Session::flash(__('Edit News Fail!'))->error();
            return redirect()->route('news.index');
        }
    }
}
