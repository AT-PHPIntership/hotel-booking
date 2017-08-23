<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Service;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::select('id', 'name')
            ->orderBy('id', 'DESC')->paginate(Service::ROW_LIMIT);
        return view("backend.services.index", compact('services'));
    }

    /**
     * Find service by id and delete service
     *
     * @param int $id id service
     *
     * @return void
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        if ($service->delete()) {
            flash(__('Delete success'))->success();
        } else {
            flash(__('Delete failure'))->error();
        }
        
        return redirect()->route('service.index');
    }
}
