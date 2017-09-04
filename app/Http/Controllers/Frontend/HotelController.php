<?php

namespace App\Http\Controllers\Frontend;

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
            $query->select('hotel_id', 'id', 'name', 'max_guest', 'price');
        };
        $with['images'] = function ($query) {
            $query->select();
        };
        $with['hotelServices'] = function ($query) {
            $query->select('id', 'hotel_id', 'service_id');
        };
        $with['ratingComments'] = function ($query) {
            $query->select();
        };
        $with['ratingComments.user'] = function ($query) {
            $query->select('id', 'username');
        };
        $with['hotelServices.service'] = function ($query) {
            $query->select('id', 'name');
        };

        $hotel = Hotel::select($columns)->with($with)->findOrFail($id);
        return view('frontend.hotels.show', compact('hotel'));
    }

}
