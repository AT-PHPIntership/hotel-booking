<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\News;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Show news of category.
     *
     * @param string $slug of category
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $news = News::where('category_id', $category->id)
                    ->orderby('created_at', 'DESC')->paginate(News::ITEM_PER_PAGE);
        return view('frontend.categories.show', compact('news', 'category'));
    }
}
