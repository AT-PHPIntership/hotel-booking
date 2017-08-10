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
                    ->orderby('id', 'ASC')->paginate(News::ROW_LIMIT);
        return view('backend.news.index', compact('news'));
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
        $newsDelete = News::findOrFail($id)->delete();
        if ($newsDelete) {
            flash(__('Delete News Success!'))->success();
            return redirect()->route('news.index');
        } else {
            flash(__('Delete News Fail!'))->error();
            return redirect()->route('news.index');
        }
    }
}
