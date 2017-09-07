<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Hotel;
use App\Model\Room;
use App\Model\Place;

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
        ];

        $with['hotels'] = function ($query) {
            $query->select('id', 'name', 'place_id', 'address', 'introduce');
        };
        // $with['hotels.rooms'] = function ($query) {
        //     $query->selectRaw('id', 'name', 'hotel_id', 'count(id) as count')->groupby();
        // };
        
        $places = Place::select($columns)->with($with)->findOrFail(8);
        // dd($places->hotels);
        // dd($hotels);
        // $countRoom = Room::withCount('reservations')->get();
        // foreach ($hotels as $key) {
        //     echo($key->rooms->count('reservations'));
        // }
        
        return view('frontend.home.index');
    }
}
