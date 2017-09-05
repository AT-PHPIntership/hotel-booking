<?php

namespace App\Http\Controllers\User;

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
            ->with(['hotelServices' => function ($query) {
                $query->join('services', 'hotel_services.service_id', '=', 'services.id');
            }])
            ->orderby('hotels.id', 'DESC')
            ->paginate(Hotel::ITEM_LIMIT)
            ->appends(['search' => request('search')]);
        $topPlaces = Hotel::select(['place_id'])
                        ->groupBy('place_id')
                        ->orderby(\DB::raw('count(*)'), 'DESC')
                        ->limit(5)->get();    
        return view('frontend.hotels.index', compact('hotels', 'topPlaces'));
    }
}
