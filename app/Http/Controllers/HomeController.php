<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Hotel;
use App\Model\Image;
use App\Model\Place;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topHotels = \Cache::remember('topHotels', Hotel::TIMEOUT_CACHE, function () {
            return $this->topHotels();
        });

        $topPlaces = \Cache::remember('topPlaces', Hotel::TIMEOUT_CACHE, function () {
            return $this->topPlaces();
        });
        $hintedPlaces = Place::topPlaces();
        return view('frontend.home.index', compact('topPlaces', 'topHotels', 'hintedPlaces'));
    }

    /**
     * Get top place follow reservations.
     *
     * @return App\Model\Place
     */
    public static function topPlaces()
    {
        $columns = [
            'places.id',
            'places.name',
            'places.slug',
            'places.image',
            'places.descript',
            DB::raw("SUM(quantityReservations) AS totalQuantity"),
            DB::raw("COUNT(hotels.id) AS totalHotels")
        ];
        return Place::select($columns)
                ->leftJoin('hotels', 'hotels.place_id', '=', 'places.id')
                ->leftJoin('rooms', 'rooms.hotel_id', '=', 'hotels.id')
                ->leftJoin(DB::raw('(SELECT reservations.room_id, SUM(quantity) AS quantityReservations FROM reservations WHERE reservations.created_at <= DATE_SUB(NOW(),INTERVAL -30 DAY) GROUP BY reservations.room_id) AS reservation_of_rooms'), 'rooms.id', '=', 'reservation_of_rooms.room_id')
                ->groupBy('places.id')
                ->orderby('totalQuantity', 'DESC')
                ->limit(Place::SHOW_HOME_LIMIT)->get();
    }

    /**
     * Get top hotels follow rating of customer.
     *
     * @return App\Model\Place
     */
    public static function topHotels()
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

        $with['place'] = function ($query) {
            $query->select('id', 'name');
        };
        $with['rooms'] = function ($query) {
            $query->select('id', 'name', 'hotel_id', 'price');
        };
        $with['rooms.images'] = function ($query) {
            $query->select();
        };
        $with['images'] = function ($query) {
            $query->select();
        };
        $with['services'] = function ($query) {
            $query->select('services.id', 'name');
        };
        return Hotel::with($with)
                ->leftJoin('rating_comments', 'hotels.id', '=', 'rating_comments.hotel_id')
                ->select($columns)
                ->groupBy('hotels.id', 'hotels.name')
                ->orderBy('total', 'DESC')
                ->limit(Hotel::SHOW_LIMIT)->get();
    }
}
