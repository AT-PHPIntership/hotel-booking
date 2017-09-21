<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Service;
use App\Model\Image;
use App\Model\Room;
use App\Model\HotelService;
use App\Model\Reservation;
use Illuminate\Http\Response;

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
            'hotels.slug',
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

    /**
     * Display hinted place after type field place-slug
     *
     * @param Request $request request to get hinted place
     *
     * @return \Illuminate\Http\Response
     */
    public function hintPlaces(Request $request)
    {
        $hintedPlaces = $request->key == "" ? Place::topPlaces() : Place::select(['name', 'slug'])->where("name", "LIKE", "%$request->key%")->limit(5)->get();
        
        return view('frontend.layouts.partials.widgetAcResult', compact('hintedPlaces'));
    }
}
