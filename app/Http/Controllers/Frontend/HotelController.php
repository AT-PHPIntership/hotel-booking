<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Service;
use App\Model\Image;
use App\Model\HotelService;
use App\Model\RatingComment;

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
        $roomColumns = [
            'hotel_id',
            'id',
            'name',
            'max_guest',
            'price',
            'size',
            'total',
            'bed',
            'direction',
            'descript'
        ];
        $commentColumns = [
            'food',
            'cleanliness',
            'comfort',
            'location',
            'service',
            'comment',
            'total_rating',
            'hotel_id',
            'user_id',
            'created_at',
        ];
        $with['place'] = function ($query) {
            $query->select('id', 'name');
        };
        $with['rooms'] = function ($query) use ($roomColumns) {
            $query->select($roomColumns)->orderBy('price', 'ASC');
        };
        $with['images'] = function ($query) {
            $query->select();
        };
        $with['hotelServices'] = function ($query) {
            $query->select('id', 'hotel_id', 'service_id');
        };
        $with['ratingComments.user'] = function ($query) {
            $query->select('id', 'username');
        };
        $with['hotelServices.service'] = function ($query) {
            $query->select('id', 'name');
        };
        $ratingComments = RatingComment::select($commentColumns)
            ->where('hotel_id', $id)->orderBy('created_at', 'DESC')
            ->paginate(5);
        $hotel = Hotel::select($columns)->with($with)->findOrFail($id);
        return view('frontend.hotels.show', compact('hotel', 'ratingComments'));
    }
}
