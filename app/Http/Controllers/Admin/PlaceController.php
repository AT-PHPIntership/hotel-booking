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
        $places = Place::select('name', 'descript', 'image')
            ->orderBy('created_at', 'DESC')->paginate(Place::NUM_ROW);
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
        if ($place == null) {
            flash(trans('admin_place.place_not_found'))->warning();
        } elseif ($place->delete()) {
            flash(trans('admin_place.delete_success'))->success();
        } else {
            flash(trans('admin_place.delete_failure'))->error();
        }
        return redirect()->route('place.index');
    }
}
