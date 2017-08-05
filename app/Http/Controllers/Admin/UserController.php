<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        // flash('kkk')->success();
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
        if (User::findOrFail($id)->delete()) {
            flash('Deletion successful')->success();
        } else {
            flash('Deletion failed')->error();
        }
        return redirect()->route('user.index');
    }
}
