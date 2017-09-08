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
use Carbon\Carbon;

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
            ->with(['hotelServices' => function ($query) {
                $query->join('services', 'hotel_services.service_id', '=', 'services.id');
            }])
            ->orderby('hotels.id', 'DESC')
            ->paginate(Hotel::ITEM_LIMIT)
            ->appends(['search' => request('search')]);
        return view('frontend.hotels.index', compact('hotels'));
    }
}
