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
     * Remove the specified resource from storage.
     *
     * @param int $hotelId id of hotel
     * @param int $id      id of room
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($hotelId, $id)
    {
        Hotel::findOrFail($hotelId);
        $room = Room::findOrFail($id);
        if ($room->delete()) {
            flash(__('Deletion successful!'))->success();
        } else {
            flash(__('Deletion failed!'))->error();
        }
        return redirect()->route('room.index', $hotelId);
    }
}
