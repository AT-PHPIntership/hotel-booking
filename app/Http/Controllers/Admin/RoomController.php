<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Backend\HotelIdRequest;
use App\Http\Controllers\Controller;
use App\Model\Room;
use App\Model\Hotel;
use App\Model\Image;
use App\Http\Requests\Backend\UpdateRoomRequest;

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
     * Show the form for editing the specified resource.
     *
     * @param Hotel $hotel hotel of room
     * @param int   $id    id of room
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel, $id)
    {
        $room = Room::findOrFail($id);
        return view('backend.rooms.edit', compact('room', 'hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoomRequest $request request to update
     * @param Hotel             $hotel   hotel of room
     * @param int               $id      id of room
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Hotel $hotel, $id)
    {
        $room = Room::findOrFail($id);
        if ($room->update($request->all())) {
            flash(__('Update successful!'))->success();
        } else {
            //If fail, back to edit page and dont save image
            flash(__('Update failure!'))->error();
            return redirect()->back()->withInput();
        }
        if (isset($request->images)) {
            Image::storeImages($request->images, 'room', $room->id, config('image.rooms.path_upload'));
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
