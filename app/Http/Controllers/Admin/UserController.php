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
        $columns = [
            'id',
            'username',
            'full_name',
            'email',
            'phone',
            'is_admin',
            'is_active',
        ];
        $users = User::select($columns)->orderby('id', 'DESC')
            ->paginate(User::ROW_LIMIT);
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
        if ($user->delete()) {
            flash(__('Deletion successful!'))->success();
        } else {
            flash(__('Deletion failed!'))->error();
        }
        return redirect()->route('user.index');
    }
}
