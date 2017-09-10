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
            }]);

        if ($request->has('hotelSourceArea')) {
            $hotels = $hotels->whereIn("hotels.place_id", function ($query) use ($request){
                $query->select('id')
                    ->from('places')
                    ->Where("name", "LIKE", "%$request->hotelSourceArea%");
            });
        }
        
        if ($request->has('arange_id') && $request->arange_id != 0) {
            if ($request->arange_id <= 2) {
                if ($request->arange_id % 2 == 0) {
                    $hotels = $hotels->join(\DB::raw("(SELECT hotel_id, max(price) AS max_price_room FROM rooms group by hotel_id) AS most_expensive_rooms"), 'most_expensive_rooms.hotel_id', '=', 'hotels.id')
                    ->orderby('max_price_room', 'DESC');
                } else {
                    $hotels = $hotels->join(\DB::raw("(SELECT hotel_id, min(price) AS min_price_room FROM rooms group by hotel_id) AS most_cheap_rooms"), 'most_cheap_rooms.hotel_id', '=', 'hotels.id')
                    ->orderby('min_price_room', 'DESC');
                }
            } elseif ($request->arange_id <= 4) {
                $hotels = $hotels->orderby('star', ($request->arange_id % 2) == 0 ? 'DESC' : 'ASC');
            } else {
                $hotels = $hotels->join(\DB::raw("(SELECT hotel_id, avg(total_rating) AS avg_rating FROM rating_comments group by hotel_id) AS summary_ratings"), 'summary_ratings.hotel_id', '=', 'hotels.id')
                    ->orderby('avg_rating', 'DESC');
            }
        }

        if ($request->has('checkin')) {
            //
        }

        $hintedPlaces = Place::topPlaces();

        $hotels = $hotels->orderby('hotels.id', 'DESC')
            ->paginate(Hotel::ITEM_LIMIT);
        return view('frontend.hotels.index', compact('hotels', 'hintedPlaces'));
    }
}
