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
}
