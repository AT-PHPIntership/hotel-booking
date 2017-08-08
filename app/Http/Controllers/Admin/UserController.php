<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('id', 'username', 'full_name', 'email', 'phone', 'is_admin', 'is_active')->orderby('id', 'DESC')
            ->paginate(10);
        return view("backend.users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request request to create
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $user = new User();
    
        $user->setAllAttribute(
            $request->input('username'),
            $request->input('password'),
            $request->input('full_name'),
            $request->input('email'),
            $request->input('phone'),
            $request->input('is_admin'),
            $request->input('is_active')
        );
        
        if ($user->save()) {
            flash(trans('admin_user.create_success'))->success();
            return redirect()->route('user.index');
        } else {
            flash(trans('admin_user.create_success'))->error();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->delete()) {
                flash(trans('admin_user.delete_success'))->success();
            } else {
                flash(trans('admin_user.delete_failure'))->error();
            }
        } catch (ModelNotFoundException $err) {
            flash(trans('admin_user.user_not_found'))->warning();
        } finally {
            return redirect()->route('user.index');
        }
    }
}
