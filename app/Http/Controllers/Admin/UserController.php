<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    public function store(Request $request)
    {
        $rules = [
            'UserName' => 'required|max:50|unique:users',
            'Password' => 'required|min:3',
            'FullName' => 'required',
            'Email' => 'required|email|unique:users',
            'Phone' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $user = new User();
    
        $user->username = $request->input('UserName');
        $user->email = $request->input('Email');
        $user->full_name = $request->input('FullName');
        $user->is_admin = $request->input('IsAdmin') != null? 1: 0;
        $user->is_active = $request->input('IsActive') != null? 1: 0;
        $user->phone = $request->input('Phone');

        if (!$request->input('Password') == '') {
            $user->password = bcrypt($request->input('Password'));
        }
        
        if ($user->save()) {
            flash('Creation successful')->success();
            return redirect()->route('user.index');
        } else {
            flash('Creation failed')->error();
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
