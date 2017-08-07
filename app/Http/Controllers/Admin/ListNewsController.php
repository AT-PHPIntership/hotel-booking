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
        $news = News::with('category')->paginate(10);
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
        $result = News::findOrFail($id)->delete();
        if ($result) {
            Session::flash('deleteSuccess', trans('admin_list_news.deleteSuccess'));
            return redirect()->route('news.index');
        } else {
            Session::flash('deleteFail', trans('admin_list_news.deleteFail'));
            return redirect()->route('news.index');
        }
    }
}
