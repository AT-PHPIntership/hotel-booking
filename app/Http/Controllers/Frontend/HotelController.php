<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Service;
use App\Model\Image;
use App\Model\HotelService;
use Illuminate\Http\Response;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request request to display
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $columns = [
            'hotels.id',
            'hotels.name',
            'address',
            'star',
            'place_id',
            'hotels.created_at'
        ];

        if ($request->has('place_id') && $request->place_id != 0) {
            $hotels = Hotel::search()
                ->select($columns)
                ->with(['hotelServices' => function ($query) {
                    $query->join('services', 'hotel_services.service_id', '=', 'services.id');
                }])
                ->where('place_id', $request->place_id)
                ->orderby('hotels.id', 'DESC')
                ->paginate(Hotel::ITEM_LIMIT)
                ->appends(['search' => request('search')]);
        } else {
            $hotels = Hotel::search()
                ->select($columns)
                ->with(['hotelServices' => function ($query) {
                    $query->join('services', 'hotel_services.service_id', '=', 'services.id');
                }])
                ->orderby('hotels.id', 'DESC')
                ->paginate(Hotel::ITEM_LIMIT)
                ->appends(['search' => request('search')]);
        }
        $topPlaces = Hotel::select(['place_id'])
                        ->groupBy('place_id')
                        ->orderby(\DB::raw('count(*)'), 'DESC')
                        ->limit(5)->get();
        return view('frontend.hotels.index', compact('hotels', 'topPlaces'));
    }
}
