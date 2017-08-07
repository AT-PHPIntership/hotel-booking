<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Session;
use App\Model\News;

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
     * @param int $id choose category delete id = $id
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
}
