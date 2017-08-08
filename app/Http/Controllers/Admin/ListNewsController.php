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
     * Delete a News.
     *
     * @param int $id of News
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = News::findOrFail($id);
            
        if ($result == null) {
            //return redirect()->route
            Session::flash('deleteSuccess', trans('admin_list_news.deleteSuccess'));
            return redirect()->route('news.index');
        } else {
            Session::flash('deleteFail', trans('admin_list_news.deleteFail'));
            return redirect()->route('news.index');
        }
    }
}
