<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Selects;
use App\Patient;
use App\UserTypes;
use Auth;

class PatientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:patient');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $userid = $user->id;

        $patient = Patient::find($userid);
        $selects = new Selects;
        $titles = $selects->getTitles('titlename', $patient->title);
        $genders = $selects->getGenders('gender', $patient->gender);
        return view('patient', compact("titles"), compact('genders'))->with('patient', $patient);
    }
}
