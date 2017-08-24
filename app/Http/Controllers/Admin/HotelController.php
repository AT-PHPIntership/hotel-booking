<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Service;
use App\Model\Image;
use App\Model\HotelService;

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
            ->paginate(Hotel::ROW_LIMIT);

        return view('backend.hotels.index', compact('hotels'));
    }

    /**
     * Show a detail of the hotel.
     *
     * @param int $id id of hotel
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get hotel infomation
        $hotel = Hotel::
            select('id', 'name', 'address', 'star', 'introduce', 'place_id')
            ->with(['place' => function ($query) {
                $query->select('id', 'name');
            }])
            ->with(['rooms' => function ($query) {
                $query->select('hotel_id', 'id', 'name');
            }])
            ->findOrFail($id);

        // get hotel Service
        $hotelServices = HotelService::select('id', 'hotel_id', 'service_id')->where('hotel_id', $id)
            ->with(['service' => function ($query) {
                $query->select('id', 'name');
            }])
            ->get();

            // get hotel images
        $hotelImages = Image::select('path')->where([
            ['target', 'hotel'],
            ['target_id', $id],
            ])->get();

        $countImages = count($hotelImages);
        $countServices = count($hotelServices);
        $countRooms = count($hotel->rooms);

        return view('backend.hotels.show', compact(
            'hotel',
            'hotelServices',
            'hotelImages',
            'countImages',
            'countServices',
            'countRooms'
        ));
    }
}
