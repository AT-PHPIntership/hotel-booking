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
        $categories = Category::select('id', 'name')->orderBy('id', 'DESC')->paginate(10);
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
            News::with('category')->delete();
                flash(trans('messages.delete_succeed'))->success();
        } else {
            flash(trans('messages.delete_fail'))->error();
        }
        return redirect()->route('category.index');
    }
}
