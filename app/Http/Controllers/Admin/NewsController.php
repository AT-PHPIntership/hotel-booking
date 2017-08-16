<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;
use App\Libraries\Traits\SearchTrait;

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
            'category_id'
        ];
        $news = News::search(request('search'), true)
                    ->select($columns)
                    ->with(['category' => function ($query) {
                        $query->select('id', 'name');
                    }])
                    ->join('categories', 'news.category_id', '=', 'categories.id')
                    ->orderby('id', 'DESC')
                    ->paginate(News::ROW_LIMIT);
        return view('backend.news.index', compact('news'));
    }

    /**
     * Search using trait.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $keyword = $request->get('search');
        $news = News::search($keyword, true)->paginate(News::ROW_LIMIT);
        return view('backend.news.index', compact('news'));
    }

}
