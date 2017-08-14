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
                    ->orderby('id', 'DESC')->paginate(News::ROW_LIMIT);
        return view('backend.news.index', compact('news'));
    }
}
