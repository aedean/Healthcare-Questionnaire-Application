<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PatientLoginController extends Controller
{
    
    public function username()
    {
        return 'username';
    }

    public function __construct()
    {
      $this->middleware('guest:patient');
    }

    public function showLoginForm()
    {
      return view('auth.patient-login');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'username'   => 'required',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('patient')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('patient.dashboard'));
      }

      var_dump(Auth::guard('patient')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember));
      var_dump($request->password);
      die;

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('username', 'remember'));
    }
}
