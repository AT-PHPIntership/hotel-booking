<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\News;
use App\Model\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaticpageController extends Controller
{
    /**
     * Show static pages
     *
     * @param string $pageName static page
     *
     * @return void
     */
    public function show($pageName)
    {
        $staticPage = StaticPage::where('slug', $pageName)->firstOrFail();

        return view('frontend.static_pages.show', compact('staticPage'));
    }
}
