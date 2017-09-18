<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    /**
     * Display form edit a News.
     *
     * @param string $slug of News
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    	// dd($request->all());
    	$test = \Cache::get('test', 'default');
    	dd($test);
    }
}
