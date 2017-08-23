<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdatePlaceRequest;
use App\Http\Requests\Backend\CreatePlaceRequest;
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
        $columns = [
            'id',
            'name',
            'descript',
            'image'
        ];
        $places = Place::search()->select($columns)->orderby('id', 'DESC')
            ->paginate(Place::ROW_LIMIT);
        $places->appends(['search' => request('search')]);
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
    public function store(CreatePlaceRequest $request)
    {
        $place = new Place($request->all());
        if ($request->hasFile('image')) {
            $place->image = config('image.name_prefix') . "-" . $request->image->hashName();
            $request->file('image')
                ->move(config('image.places.path_upload'), $place->image);
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
        $place = Place::findOrFail($id);
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
            $fileName = config('image.name_prefix') . "-" . $file->hashName();
            $file->move(config('image.places.path_upload'), $fileName);
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

    /**
     * Show a detail of the place.
     *
     * @param int $id id of place
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::findOrFail($id);
        $totalHotels = $place->hotels()->count();
        return view('backend.places.show', compact('place', 'totalHotels'));
    }
}
