<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Service;
use App\Model\Image;
use App\Model\HotelService;
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
     * @param HotelCreateRequest $request Request create
     *
     * @return \Illuminate\Http\Response
     */
    public function store(HotelCreateRequest $request)
    {
        // create hotel.
        $hotel = new Hotel($request->except(['services', 'images']));
        $result = $hotel->save();
        // add hotel services
        $hotelServices = $request->services;
        foreach ($hotelServices as $serviceId) {
            $hotelService = new HotelService(['service_id' => $serviceId]);
            $hotel->hotelServices()->save($hotelService);
        }
        // add hotel images
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $imageName = config('image.name_prefix') . "-" . $image->hashName();
                $imagePath = config('image.hotels.path_upload') . $imageName;
                $image->move(config('image.hotels.path_upload'), $imageName);
                $image = new Image([
                    'target'=>'hotel',
                    'target_id' => $hotel->id,
                    'path' => $imagePath
                    ]);
                $image->save();
            }
        }

        if ($result) {
            flash(__('Create success'))->success();
            return redirect()->route('hotel.index');
        } else {
            flash(__('Create failure'))->error();
            return redirect()->back()->withInput();
        }
    }
}
