<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;

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
}
