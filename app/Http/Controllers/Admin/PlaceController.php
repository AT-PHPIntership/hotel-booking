<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Place;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::select('id', 'name', 'descript', 'image', 'created_at')
            ->orderBy('created_at', 'DESC')->paginate(Place::ROW_LIMIT);
        return view("backend.places.index", compact('places'));
    }

    /**
     * Find place by id and delete place
     *
     * @param int $id id place
     *
     * @return void
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        if ($place->delete()) {
            flash(__('Delete success'))->success();
        } else {
            flash(__('Delete failure'))->error();
        }
        
        return redirect()->route('place.index');
    }
}
