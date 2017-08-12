<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminCreatePlace;
use App\Http\Requests\Backend\UpdatePlaceRequest;
use App\Model\Place;
use App\Helpers\AdminPlaceHelper;

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
     * Show the form for editing the specified resource.
     *
     * @param int $id id of place
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::find($id);
        return view('backend.places.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateRequest $request request to update
     * @param int                            $id      id of place
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlaceRequest $request, $id)
    {
        $place = Place::findOrFail($id);
        $input = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = config('constant.current_day') . "-" . $file->hashName();
            $file->move(config('constant.path_upload_places'), $fileName);
            $input['image'] = $fileName;
        }
        if ($place->update($input)) {
            flash(__('Update success'))->success();
            return redirect()->route('place.index');
        } else {
            flash(__('Update failure'))->error();
            return redirect()->back()->withInput();
        }
        
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
