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

        /**
     * Show the form for creating a new room.
     *
     * @param Request $request request to create
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Hotel::findOrFail($request->id);
        return view('backend.rooms.create');
    }

    /**
     * Store a newly created room in storage.
     *
     * @param Admin\RoomRequest $request request from view
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        Hotel::findOrFail($request->id);
        $room = new room($request->all());
        $room->hotel_id = $request->id;
        if ($room->save()) {
            flash(__('Creation successful!'))->success();
        } else {
            //If fail, back to create page and dont save image
            flash(__('Creation failure!'))->error();
            return redirect()->back()->withInput();
        }
        if (isset($request->image)) {
            foreach ($request->image as $img) {
                $nameImage = config('image.name_prefix') . "-" . $img->hashName();
                $path = config('image.rooms.path_upload').$nameImage;
                Image::create([
                    'target' => 'room',
                    'target_id' => $room->id,
                    'path' => $path
                ]);
                $img->move(config('image.rooms.path_upload'), $nameImage);
            }
        }
        return redirect()->route('room.index');
    }
}
