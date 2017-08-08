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
