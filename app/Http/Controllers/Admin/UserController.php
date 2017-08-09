<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Http\Requests\UpdateUserRequest;

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->update($request->all())) {
            flash(__('Update successful!'))->success();
            return redirect()->route('user.index');
        } else {
            flash(__('Update failed!'))->error();
            return redirect()->back()->withInput();
        }
    }
}
