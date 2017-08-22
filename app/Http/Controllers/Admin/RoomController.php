<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Room;
use App\Model\Image;
use App\Http\Requests\Backend\CreateRoomRequest;

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

        /**
     * Show the form for creating a new room.
     *
     * @param int $hotelId id of hotel
     *
     * @return \Illuminate\Http\Response
     */
    public function create($hotelId)
    {
        return view('backend.rooms.create', compact('hotelId'));
    }

    /**
     * Store a newly created room in storage.
     *
     * @param AdminCreateroom $request request from view
     * @param int             $hotelId id of hotel
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoomRequest $request, $hotelId)
    {
        $room = new room($request->all());
        $room->hotel_id = $hotelId;
        if ($room->save()) {
            flash(__('Creation successful!'))->success();
        } else {
            //If fail, back to create page and dont save image
            flash(__('Creation failure!'))->error();
            return redirect()->route('room.create');
        }
        if (isset($request->image)) {
            foreach ($request->image as $img) {
                $nameImage = config('image.name_prefix') . "-" . $img->hashName();
                $path = config('image.rooms.path_upload').$nameImage;
                $image = new Image();
                $image->target = 'room';
                $image->target_id = $room->id;
                $image->path = $path;
                $image->save();
                $img->move(config('image.rooms.path_upload'), $nameImage);
            }
        }
        return redirect()->route('room.index', $hotelId);
    }
}
