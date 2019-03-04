<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\UserTypes;

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
    public $titles = array('Miss', 'Mr', 'Mrs', 'Ms', 'Other');

    public function showRegistrationForm()
    {
        $titles = $this->getTitlesHTML();
        $usertype = $this->getUserTypesHTML();
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
            'title' => 'required|string|max:25',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'dob' => 'required|date|date_format:Y-m-d',
            'email' => 'required|string|email|max:255|unique:users',
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
            'title' => $data['title'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'dob' => $data['dob'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getTitles() 
    {
        return $this->titles;
    }

    public function getTitlesHTML() 
    {
        $titles = $this->getTitles();
        $titlesHTML = '<select name="title" class="form-control" id="title">';
        foreach($titles as $title)
        {
            $titlesHTML .= '<option value="' . $title . '">' . $title . '</option>';
        }
        $titlesHTML .= '</select>';
        return $titlesHTML;
    }

    public function getUserTypes()
    {
        return UserTypes::all();
    }

    public function getUserTypesHTML()
    {
        $usertypes = $this->getUserTypes();
        $usertypesHTML = '<select name="usertypeid" class="form-control" id="usertypeid">';
        foreach($usertypes as $usertype)
        {
            $usertypesHTML .= '<option value="' . $usertype->usertypeid . '">' . $usertype->usertypename . '</option>';
        }
        $usertypesHTML .= '</select>';
        return $usertypesHTML;
    }
}
