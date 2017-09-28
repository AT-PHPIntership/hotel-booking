<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Frontend\RegisterRequest;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = '/registerSuccess';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest', 'frontend.language']);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('frontend.users.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param App\Http\Requests\Frontend\RegiserterRequest $request of form register
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data data to create user
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create(array_merge($data, ['is_active' => User::STATUS_ACTIVED]));
    }
}
