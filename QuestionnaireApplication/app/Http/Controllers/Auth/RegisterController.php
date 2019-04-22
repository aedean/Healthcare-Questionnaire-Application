<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Helpers\Selects;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function showRegistrationForm()
    {
        $selects = new Selects;
        $titles = $selects->getTitles();
        $usertype = $selects->getUserTypes();
        return view("auth.register", compact("titles"), compact('usertype'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {    
        //need to get user types
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'usertypeid' => 'required|int|max:5',
            'username' => 'required|string|max:255|unique:users',
            'title' => 'max:25|nullable',
            'firstname' => 'max:255|nullable',
            'lastname' => 'max:255|nullable',
            'email' => 'max:255|nullable|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'usertypeid' => $data['usertypeid'],
            'username' => $data['username'],
            'title' => $data['title'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
