<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Image;
use App\Model\News;
use App\Http\Requests\Backend\EditNewsRequest;
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
            'content',
            'news.slug',
            'categories.name'
        ];
        $news = News::search()
                    ->select($columns)
                    ->orderby('news.id', 'DESC')
                    ->paginate(News::ROW_LIMIT);
        $news->appends(['search' => request('search')]);
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
        } else {
            flash(__('Create News Fail!'))->error();
            return redirect()->back()->withInput();
        }
        Image::storeImages($request->images, 'news', $news->id, config('image.news.path_upload'));
        return redirect()->route('news.index');
    }

    /**
     * Display form edit a News.
     *
     * @param string $slug of News
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $columns = [
                    'id',
                    'title',
                    'content',
                    'category_id'
        ];
        $news = News::select($columns)
                    ->where('slug', $slug)
                    ->firstOrFail();
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
        $newsUpdate = News::findOrFail($id);
        if ($newsUpdate->update($request->all())) {
            flash(__('Edit News Success!'))->success();
        } else {
            flash(__('Edit News Fail!'))->error();
            return redirect()->back()->withInput();
        }
        if (isset($request->images)) {
            Image::storeImages($request->images, 'news', $newsUpdate->id, config('image.news.path_upload'));
        }
        return redirect()->route('news.index');
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
