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
     * @param int $hotelId id of hotel
     *
     * @return \Illuminate\Http\Response
     */
    public function index($hotelId)
    {
        Hotel::findOrFail($hotelId);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id id of room
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($hotelId, $id)
    {
        Hotel::findOrFail($hotelId);
        $room = Room::findOrFail($id);
        return view('backend.rooms.edit', compact('room', 'hotelId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateRequest $request request to update
     * @param int                            $id      id of room
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, $hotelId, $id)
    {
        $room = Room::findOrFail($id);

        if ($room->update($request->all())) {
            flash(__('Update successful!'))->success();
            return redirect()->route('room.index');
        } else {
            flash(__('Update failed!'))->error();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove image.
     *
     * @param int $id id of image
     *
     * @return int
     */
    public function removeImage($id)
    {
        $image = Image::findOrFail($id);
        if ($image->delete()) {
            return 1;
        }
        return 0;
    }

}
