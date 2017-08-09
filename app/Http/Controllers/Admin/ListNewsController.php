<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;
use App\Http\Requests\CreateNewsRequest;
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
     * Create a new News.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.news.create');
    }

    /**
     * Store a newly News in storage.
     *
     * @param \Illuminate\Http\CreateNewsRequest $request of form creat News
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNewsRequest $request)
    {
        $news = new News($request->all());
        $result = $news->save();
        if ($result) {
            flash(__('Create News Success!'))->success();
            return redirect()->route('news.index');
        } else {
            flash(__('Create News Fail!'))->error();
            return redirect()->route('news.index');
        }
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
     * Display a listing of news.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
    }
}
