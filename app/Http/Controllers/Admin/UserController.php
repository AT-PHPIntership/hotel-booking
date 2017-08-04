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
}
