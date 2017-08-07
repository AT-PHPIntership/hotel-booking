<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Session;
use App\Model\News;
use App\Http\Requests\CategoryRequest;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id choose category delete
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Category::findOrFail($id)->delete()) {
            if (News::with('category')->delete()) {
                flash(trans('messages.delete_succeed'))->success();
            }
        } else {
            flash(trans('messages.delete_succeed'))->error();
        }
        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id call category have id = $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request call All of Category
     * @param int                      $id      call category have id = $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if (Category::findOrFail($id)->update($request->all())) {
            flash(trans('messages.update_succeed'))->success();
        } else {
            flash(trans('messages.update_succeed'))->error();
        }
        return redirect()->route('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request send request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category($request->all());
        if ($category->save()) {
            flash(trans('messages.create_succeed'))->success();
        } else {
            flash(trans('messages.create_succeed'))->error();
        }
        return redirect()->route('category.index');
    }
}
