<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Http\Requests\Backend\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::search()
                                ->select('id', 'name')
                                ->orderBy('id', 'DESC')
                                ->paginate(Category::ROW_LIMIT);
        $categories->appends(['search'=>request('search')]);
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
     * @param CategoryRequest $request call All of Category
     * @param int             $id      call category have id = $id
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
     * @param CategoryRequest $request send request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category($request->all());
        if ($category->save()) {
            flash(__('Create Success'))->success();
        } else {
            flash(__('Create Fail'))->error();
        }
        return redirect()->route('category.index');
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
            flash(__('Delete Success'))->success();
        } else {
            flash(__('Delete Fail'))->error();
        }
        return redirect()->route('category.index');
    }
}
