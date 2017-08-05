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
        $users = User::select('id', 'username', 'full_name', 'email', 'phone', 'is_admin', 'is_active')->orderby('id', 'DESC')
            ->paginate(10);
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
        $user = User::findOrFail($id);
        if ($user == null) {
            flash(trans('admin_user.user_not_found'))->warning();
        } elseif ($user->delete()) {
            flash(trans('admin_user.delete_success'))->success();
        } else {
            flash(trans('admin_user.delete_failure'))->error();
        }
        return redirect()->route('user.index');
    }
}
