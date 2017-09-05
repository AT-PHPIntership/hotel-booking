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
        $columns = [
            'hotels.id',
            'hotels.name',
            'address',
            'star',
            'place_id',
            'hotels.created_at'
        ];

        $hotels = Hotel::search()
            ->select($columns)
            ->orderby('hotels.id', 'DESC')
            ->paginate(Hotel::ROW_LIMIT)
            ->appends(['search' => request('search')]);
        
        return view('backend.hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = [
            'id',
            'name'
        ];
        $places = Place::select($columns)->get();
        $services = Service::select($columns)->get();

        return view('backend.hotels.create', compact('places', 'services'));
    }

    /**
     * Save creating hotel
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

        //make data hotel services
        $hotelServices = array();
        if (isset($request->services)) {
            foreach ($request->services as $serviceId) {
                array_push($hotelServices, new HotelService(['service_id' => $serviceId]));
            }
        }
        //save hotel services
        $hotel->hotelServices()->saveMany($hotelServices);

        Image::storeImages($request->images, 'hotel', $hotel->id, config('image.hotels.path_upload'));

        if ($result) {
            flash(__('Create success'))->success();
            return redirect()->route('hotel.index');
        } else {
            flash(__('Create failure'))->error();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show hotel
     *
     * @param int $id id of hotel
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $columns = [
            'id',
            'name',
            'address',
            'star',
            'introduce',
            'place_id'
        ];

        $with['place'] = function ($query) {
            $query->select('id', 'name');
        };
        $with['rooms'] = function ($query) {
            $query->select('hotel_id', 'id', 'name');
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

        $hotel = Hotel::select($columns)->with($with)->findOrFail($id);

        return view('backend.hotels.show', compact('hotel'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id id of hotel
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        if ($hotel->delete()) {
            flash(__('Deletion successful!'))->success();
        } else {
            flash(__('Deletion failed!'))->error();
        }
        return redirect()->route('hotel.index');
    }
}
