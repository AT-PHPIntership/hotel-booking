<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;
use App\Model\Category;
use App\Http\Requests\Backend\CreateNewsRequest;

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
            'news.id',
            'title',
            'news.slug',
            'content',
            'category_id',
            'name'
        ];
        $news = News::select($columns)
                    ->join('categories', 'news.category_id', '=', 'categories.id')
                    ->orderby('news.id', 'DESC')->paginate(News::ROW_LIMIT);
        return view('backend.news.index', compact('news'));
    }

    /**
     * Create a new News.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('backend.news.create', compact('categories'));
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
            return redirect()->route('news.create');
        }
    }
}
