<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\HotelIdRequest;
use App\Http\Controllers\Controller;
use App\Model\Room;
use App\Model\Hotel;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Hotel $hotel hotel of room
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Hotel $hotel)
    {
        $columns = [
            'id',
            'name',
            'descript',
            'price',
            'size',
            'total',
            'max_guest',
            'hotel_id'
        ];
        $rooms = Room::select($columns)
            ->with(['images'])
            ->where('hotel_id', $hotel->id)
            ->orderBy('id', 'DESC')
            ->paginate(Room::ROW_LIMIT);
        return view('backend.rooms.index', compact('rooms'));
    }
}
