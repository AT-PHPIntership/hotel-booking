<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Room;
use App\Model\Hotel;

class RoomController extends Controller
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
        Hotel::findOrFail($request->id);
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
            ->where('hotel_id', $request->id)
            ->orderBy('id', 'DESC')
            ->paginate(Room::ROW_LIMIT);
        return view('backend.rooms.index', compact('rooms'));
    }
}
