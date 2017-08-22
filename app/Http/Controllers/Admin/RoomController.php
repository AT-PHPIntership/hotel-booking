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
     * @param int $hotel_id id of hotel
     *
     * @return \Illuminate\Http\Response
     */
    public function index($hotel_id)
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
            ->where('hotel_id', '=', $hotel_id)
            ->orderBy('id', 'DESC')
            ->paginate(Room::ROW_LIMIT);
        return view('backend.rooms.index', compact('rooms', 'hotel_id'));
    }

        /**
     * Show the form for creating a new room.
     *
     * @param int $hotel_id id of hotel
     *
     * @return \Illuminate\Http\Response
     */
    public function create($hotel_id)
    {
        return view('backend.rooms.create', compact('hotel_id'));
    }

    /**
     * Store a newly created room in storage.
     *
     * @param AdminCreateroom $request request from view
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoomRequest $request, $hotel_id)
    {
        // $room = new room($request->all());
        // if ($request->hasFile('image')) {
        //     $room->image = config('image.name_prefix') . "-" . $request->image->hashName();
        //     $request->file('image')
        //         ->move(config('image.rooms.path_upload'), $room->image);
        // }
        // if ($room->save()) {
        //     flash(__('Create success'))->success();
        // } else {
        //     flash(__('Create failure'))->error();
        // }
        
        return redirect()->route('room.index', $hotel_id);
    }
}
