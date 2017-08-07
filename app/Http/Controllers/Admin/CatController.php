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
                flash('Delete succeed')->success();
            }
        } else {
            flash('Delete fail')->error();
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
        $this->validate($request, [
            'name' => 'required|between:2,30'
            ]);
        if (Category::findOrFail($id)->update($request->all())) {
            flash('Update succeed')->success();
        } else {
            flash('Update fail')->error();
        }
        return redirect()->route('category.index');
    }
}
