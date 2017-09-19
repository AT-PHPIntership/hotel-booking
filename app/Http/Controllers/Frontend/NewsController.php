<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\News;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    /**
     * Display resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsColumns = [
            'id',
            'title',
            'content',
            'slug'
        ];
        $categoryColumns = [
            'categories.id',
            'name',
            'slug'
        ];
        $categories = Category::select($categoryColumns)
            ->whereHas('news', function ($query) {
                $query->limit(News::ITEM_LIMIT);
            }, '>', 0)
            ->orderby('categories.id', 'DESC')
            ->paginate(Category::ITEM_LIMIT);
        $news = News::select($newsColumns)
            ->orderby('created_at', 'DESC')
            ->limit(News::TOP_NEWS)
            ->get();
        return view('frontend.news.index', compact('news', 'categories'));
    }

    /**
     * Show detail news.
     *
     * @param string $slug id of news
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $category = Category::where('id', $news->category_id)
                        ->with(['news' => function ($query) use ($news) {
                            $query->where('id', '!=', $news->id)
                                ->limit(News::ITEM_LIMIT)
                                ->orderby('created_at', 'DESC');
                        }])
                        ->firstOrFail();
        return view('frontend.news.show', compact('news', 'category'));
    }
}
