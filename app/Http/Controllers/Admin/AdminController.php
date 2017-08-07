<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Return the view index page.
     *
     * @return view
    */
    public function index()
    {
        return view('backend.home.index');
    }
}
