<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Hotel;
use App\Model\Room;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = [
            'id',
            'name',
            'address',
            'star',
            'introduce',
            'place_id',
        ];

        $with['place'] = function ($query) {
            $query->select('id', 'name');
        };
        $with['rooms'] = function ($query) {
            $query->select('hotel_id', 'id', 'name')->with('reservations');
        };
        $with['images'] = function ($query) {
            $query->select();
        };
        $with['hotelServices'] = function ($query) {
            $query->select('id', 'hotel_id', 'service_id');
        };
        $with['hotelServices.service'] = function ($query) {
            $query->select('id', 'name');
        };

        $hotels = Hotel::select($columns)->with($with)->limit(4)->orderby('id', 'DESC')->get();
        // dd($hotels);
        // $countRoom = Room::withCount('reservations')->get();
        foreach ($hotels as $key) {
            echo($key->rooms->count('reservations'));
        }
        
        // return view('frontend.home.index');
    }
}
