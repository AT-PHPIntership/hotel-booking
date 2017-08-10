<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('id', 'name')->orderBy('id', 'DESC')->paginate(Category::ROW_LIMIT);
        return view('backend.categories.index', compact('categories'));
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
        $category = Category::select('id', 'name')->findOrFail($id);
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
            flash(__('Update Success'))->success();
        } else {
            flash(__('Update Fail'))->error();
        }
        return redirect()->route('category.index');
    }
}
