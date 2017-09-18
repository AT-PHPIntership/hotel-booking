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
use App\Http\Requests\Frontend\SearchHotelRequest;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *@param SearchHotelRequest $request request to display
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchHotelRequest $request)
    {
        \Cache::put('test', $request->all(), 5);
        $columns = [
            'hotels.id',
            'hotels.name',
            'address',
            'star',
            'place_id',
            'hotels.created_at'
        ];
        $hotels = Hotel::select($columns)
            ->with(['hotelServices' => function ($query) {
                $query->join('services', 'hotel_services.service_id', '=', 'services.id');
            }])
            ->placeCondition($request)
            ->orderCondition($request)
            ->checkinCondition($request, $columns)
            ->orderby('hotels.id', 'DESC')
            ->paginate(Hotel::ITEM_LIMIT);
        // Top 7 place booked most within the last month
        $hintedPlaces = Place::topPlaces();
        return view('frontend.hotels.index', compact('hotels', 'hintedPlaces'));
    }
}
