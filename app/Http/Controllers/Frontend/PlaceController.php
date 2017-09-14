<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Place;
use App\Model\Hotel;
use App\Model\Image;
use App\Model\HotelService;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    /**
     * Show place
     *
     * @param string $slug slug of place
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $columns = [
            'id',
            'name',
            'descript',
            'image',
            'slug'
        ];

        $place = Place::select($columns)
            ->withCount('hotels')
            ->where('slug', $slug)
            ->firstOrFail();

        $hotels = $this->getListHotels($place->id);
        return view('frontend.places.show', compact('place', 'hotels'));
    }

    /**
     * Get hotels list
     *
     * @param int $id id of place
     *
     * @return App\Molel\Hotel
     */
    private function getListHotels($id)
    {
        $columns = [
            'hotels.id',
            'hotels.name',
            'hotels.address',
            'hotels.star',
            'hotels.introduce',
            'hotels.place_id',
            DB::raw('AVG(rating_comments.total_rating) as total')
        ];
        $with['images'] = function ($query) {
            $query->select();
        };
        $with['services'] = function ($query) {
            $query->select('services.id', 'hotel_services.hotel_id', 'hotel_services.service_id', 'services.name')->limit(HotelService::SHOW_LIMIT);
        };

        $hotels = Hotel::with($with)
            ->leftJoin('rating_comments', 'hotels.id', '=', 'rating_comments.hotel_id')
            ->select($columns)
            ->groupBy('hotels.id', 'hotels.name')
            ->orderBy('total', 'DESC')
            ->where('hotels.place_id', $id)
            ->paginate(Hotel::ITEM_LIMIT);
        return $hotels;
    }
}
