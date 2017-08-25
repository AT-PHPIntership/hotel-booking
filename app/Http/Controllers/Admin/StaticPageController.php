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
        $staticPages = StaticPage::select('id', 'title')
                                 ->orderby('id', 'DESC')
                                 ->paginate(StaticPage::ROW_LIMIT);
        return view('backend.static_pages.index', compact('staticPages'));
    }
}
