<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Service;
use App\Model\Image;
use App\Model\Room;
use App\Model\HotelService;
use App\Model\Reservation;
use Illuminate\Http\Response;

class PlaceController extends Controller
{
    /**
     * Display hinted place after type field place-slug
     *
     * @param Request $request request to get hinted place
     *
     * @return \Illuminate\Http\Response
     */
    public function hintPlaces(Request $request)
    {
        $hintedPlaces = $request->key == "" ? Place::topPlaces() : Place::select(['name', 'slug'])->where("name", "LIKE", "%$request->key%")->limit(5)->get();
        
        return view('frontend.layouts.partials.widgetAcResult', compact('hintedPlaces'));
    }
}
