<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $hotelId id of hotel
     *
     * @return \Illuminate\Http\Response
     */
    public function index($hotelId)
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
            ->where('hotel_id', '=', $hotelId)
            ->orderBy('id', 'DESC')
            ->paginate(Room::ROW_LIMIT);
        return view('backend.rooms.index', compact('rooms', 'hotelId'));
    }
}
