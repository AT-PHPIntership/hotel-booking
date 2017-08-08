<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\News;
use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\EditNewsRequest;
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
    }

    /**
     * Store a newly News in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    }

     /**
     * Display form edit a News.
     *
     * @param int $id of News
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::where('slug', $id)->first();
        return view('backend.news.edit', compact('news'));
    }

     /**
     * Update information of a News
     *
     * @param \App\Http\Requests\EditNewsRequest $request of form Edit News
     * @param int                                $id      of News
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EditNewsRequest $request, $id)
    {
        $news = News::find($id);
        $news->Update($request->all());
        if ($news->update()) {
            Session::flash('successEdit', trans('admin_list_news.successEdit'));
            return redirect()->route('news.index');
        } else {
            Session::flash('failEdit', trans('admin_list_news.failEdit'));
            return redirect()->route('news.index');
        }
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
