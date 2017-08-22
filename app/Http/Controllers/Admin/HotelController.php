<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Service;
use App\Model\HotelService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Backend\HotelCreateRequest;
use Illuminate\Http\Response;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::
            select('id', 'name', 'address', 'star', 'place_id', 'created_at')
            ->with(['place' => function ($query) {
                $query->select('id', 'name');
            }])
            ->with(['rooms' => function ($query) {
                $query->select('hotel_id', 'id');
            }])
            ->orderby('id', 'DESC')->paginate(Hotel::ROW_LIMIT);

        return view('backend.hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Place::select('id', 'name')->get();
        $services = Service::select('id', 'name')->get();

        return view('backend.hotels.create', compact('places', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(HotelCreateRequest $request)
    {
       
        $hotels = $request->except(['services', 'images']);
        // dd($hotels);
         $hotel = new Hotel($hotels);
         // dd($hotel);
        // $result = $hotel->save();
        // dd($hotel->id);

        // $HotelServices = $request->services;
        // $array = [];
        
        // $hotel->hotelServices()->saveMany([
        //     new HotelService(['service_id' => 1]),
        //     new HotelService(['service_id' => 1]),
        //     new HotelService(['service_id' => 1]),

        //     ]);

        // dd($HotelServices);
        // $resultssss = new HotelService($HotelServices);
        // $rs = $resultssss->save();
        if ($images = $request->images){
            // $place ->image= $request->image->hashName();
            // $request->file('image')
            //     ->move(config('constant.path_upload_places'), $place->image);
            dd($images);
        }
        // if ($result) {
        //             flash(__('Create success'))->success();
        //             // dd($hotel->id);
        //             $data = array();
        //         } else {
        //             flash(__('Create failure'))->error();
        //         }
        // return redirect()->route('hotel.index');
        // // $images=array();
        // //     if($files = $request->file('imgs[]')){
        // //         foreach($files as $file){
        // //             $name=$file->getClientOriginalName();
        // //             $file->move('imgs[]',$name);
        // //             $images[]=$name;
        // //             dd($images);
        // //     }
        // // }

        // $result = DB::transaction(function() use ($hotel) {
        //     $hotel->save();
        // });
        // dd($result);    
    }
}
