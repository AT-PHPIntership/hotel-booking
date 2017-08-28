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
        $rooms = Room::search()
            ->select($columns)
            ->with(['images'])
            ->where('hotel_id', $hotel->id)
            ->orderBy('id', 'DESC')
            ->paginate(Room::ROW_LIMIT)
            ->appends(['search' => request('search')]);
        return view('backend.rooms.index', compact('rooms', 'hotel'));
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
