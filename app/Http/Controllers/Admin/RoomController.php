<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Room;
use App\Model\Hotel;
use App\Model\Image;
use App\Http\Requests\Backend\RoomRequest;

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
        return view('backend.rooms.index', compact('rooms', 'hotel'));
    }

    /**
     * Show the form for creating a new room.
     *
     * @param Hotel $hotel hotel of room
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Hotel $hotel)
    {
        return view('backend.rooms.create', compact('hotel'));
    }

    /**
     * Store a newly created room in storage.
     *
     * @param Admin\RoomRequest $request request from view
     * @param Hotel             $hotel   hotel of room
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request, Hotel $hotel)
    {
        $room = new Room($request->all());
        $room->hotel_id = $hotel->id;
        if ($room->save()) {
            flash(__('Creation successful!'))->success();
        } else {
            //If fail, back to create page and dont save image
            flash(__('Creation failure!'))->error();
            return redirect()->back()->withInput();
        }
        if (isset($request->image)) {
            Image::storeImages($request->image, 'room', $room->id, config('image.rooms.path_upload'));
        }
        return redirect()->route('room.index', $hotel->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hotel $hotel hotel of room
     * @param int   $id    id of room
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel, $id)
    {
        $room = Room::findOrFail($id);
        if ($room->delete()) {
            flash(__('Deletion successful!'))->success();
        } else {
            flash(__('Deletion failed!'))->error();
        }
        return redirect()->route('room.index', $hotel->id);
    }
}
