<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;
use Session;

class ListNewsController extends Controller
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
     * Display a listing of news.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Display a listing of news.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    }

    /**
     * Display a listing of news.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Display a listing of news.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
    }

    /**
     * Delete a News.
     *
     * @param int $id of News
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = News::findOrFail($id)->delete();
        if ($result) {
            flash(__('Delete News Success!'))->success();
            return redirect()->route('news.index');
        } else {
            flash(__('Delete News Fail!'))->error();
            return redirect()->route('news.index');
        }
    }
}
