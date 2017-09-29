<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Http\Requests\Backend\UpdateUserRequest;
use App\Http\Requests\Backend\CreateUserRequest;
use Illuminate\Support\Facades\Auth;

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
        $users = User::search()
                     ->select($columns)
                     ->orderby('id', 'DESC')
                     ->paginate(User::ROW_LIMIT);
        $users->appends(['search' => request('search')]);
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
     * @param \Illuminate\Http\CreateUserRequest $request request to create
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        if (User::create($request->all())) {
            flash(__('Creation successful!'))->success();
            return redirect()->route('user.index');
        } else {
            flash(__('Creation failed!'))->error();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateRequest $request request to update
     * @param int                            $id      id of user
     *
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            flash(__('User is logging! Can\'t delete this user!'))->warning();
        } else {
            $user = User::findOrFail($id);
            if ($user->delete()) {
                flash(__('Deletion successful!'))->success();
            } else {
                flash(__('Deletion failed!'))->error();
            }
        }
        
        return redirect()->route('user.index');
    }

    /**
     * Update status of user.
     *
     * @param int $id id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        $user = User::findOrFail($id);
        if ($user->is_active == User::STATUS_ACTIVED) {
            $user->update(['is_active' => User::STATUS_DISABLED]);
        } else {
            $user->update(['is_active' => User::STATUS_ACTIVED]);
        }
        flash(__('Change status successful!'))->success();
        return redirect()->route('user.index');
    }

    /**
     * Update role of user.
     *
     * @param int $id id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRole($id)
    {
        $user = User::findOrFail($id);
        if ($user->is_admin == User::ROLE_ADMIN) {
            $user->update(['is_admin' => User::ROLE_USER]);
        } else {
            $user->update(['is_admin' => User::ROLE_ADMIN]);
        }
        flash(__('Change role successful!'))->success();
        return redirect()->route('user.index');
    }

     /**
     * Display the specified resource.
     *
     * @param int $id id of user
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.show', compact('user'));
    }
}
