<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\StaticPage;

class StaticPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $static_pages = StaticPage::select('id', 'title', 'content')
                                 ->orderby('id', 'DESC')
                                 ->paginate();
        return view('backend.static_pages.index', compact('static_pages'));
    }
}
