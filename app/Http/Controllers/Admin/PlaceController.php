<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminCreatePlace;
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
            ->orderBy('id', 'DESC')->paginate(Place::ROW_LIMIT);
        return view("backend.places.index", compact('places'));
    }

    /**
     * Show the form for creating a new place.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.places.create');
    }

    /**
     * Store a newly created place in storage.
     *
     * @param AdminCreatePlace $request request from view
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCreatePlace $request)
    {
        $place = new Place($request->all());
        if ($request->hasFile('image')) {
            $place ->image= $request->image->hashName();
            $request->file('image')
                ->move(config('constant.path_upload_places'), $place->image);
        }
        if ($place->save()) {
            flash(__('Create success'))->success();
        } else {
            flash(__('Create failure'))->error();
        }
        
        return redirect()->route('place.index');
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
