<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;
use App\Http\Requests\Backend\EditNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of news.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'content',
            'category_id'
        ];
        $news = News::select($columns)
                    ->with(['category' => function ($query) {
                        $query->select('id', 'name');
                    }])
                    ->orderby('id', 'ASC')->paginate(News::ROW_LIMIT);
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
        $columns = [
                    'id',
                    'title',
                    'content',
                    'category_id'
        ];
        $news = News::where('slug', $slug)
                    ->select($columns)
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
        $newsUpdate = News::findOrFail($id)->Update($request->all());
        if ($newsUpdate) {
            flash(__('Edit News Success!'))->success();
            return redirect()->route('news.index');
        } else {
            flash(__('Edit News Fail!'))->error();
            return redirect()->route('news.index');
        }
    }
}
