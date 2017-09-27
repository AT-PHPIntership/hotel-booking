<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('frontend.users.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest', 'frontend.language'], ['except' => 'logout']);
        Session::put('backUrl', URL::previous());
    }

    /**
     * Redirect to previous page or redirect to default redirect
     *
     * @return mixed
     */
    public function redirectTo()
    {
        return Session::get('backUrl') ? Session::get('backUrl') :   $this->redirectTo;
    }
    /**
     * Validate the user login request.
     *
     * @param \Illuminate\Http\Request $request of Form Login
     *
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string|exists:users,username,is_active,1',
            'password' => 'required|string',
        ]);
    }
}
