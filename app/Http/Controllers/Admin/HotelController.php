<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Hotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::
            select('id', 'name', 'address', 'star', 'place_id', 'created_at')
            ->with(['place' => function ($query) {
                $query->select('id', 'name');
            }])
            ->with(['rooms' => function ($query) {
                $query->select('hotel_id', 'id');
            }])
            ->paginate(Hotel::ROW_LIMIT);

        return view('backend.hotels.index', compact('hotels'));
    }
}
