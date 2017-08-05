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
