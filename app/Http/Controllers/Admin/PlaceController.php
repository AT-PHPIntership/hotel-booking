<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Place;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::select('name', 'descript', 'image')
            ->orderBy('created_at', 'DESC')->paginate(Place::NUM_ROW);
        return view("backend.places.index", compact('places'));
    }
}
