<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Selects;
use App\Patient;
use App\UserTypes;
use App\Validator\Forms;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selects = new Selects;
        $titles = $selects->getTitles();
        $genders = $selects->getGenders();
        return view('patients.create', compact('titles'), compact('genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|alpha_dash|max:255|unique:patients',
            'title' => 'max:25|string|alpha|nullable',
            'firstname' => 'max:255|string|alpha|nullable',
            'lastname' => 'max:255|string|alpha|nullable',
            'gender' => 'max:255|string|alpha|nullable',
            'dob' => 'max:255|date|nullable',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator->errors());
        }

        $patientTypeId = UserTypes::where('usertypename', '=', 'Patient')->first();

        $patient = new Patient;
        $patient->usertypeid = $patientTypeId->usertypeid;
        $patient->username = $request->input('username');
        $patient->title = $request->input('title');
        $patient->firstname = $request->input('firstname');
        $patient->lastname = $request->input('lastname');
        $patient->dob = $request->input('dob');
        $patient->gender = $request->input('gender');
        $patient->password =  bcrypt($request->input('password'));
        $patient->save();

        $patientStoreRedirectUrl = '/patients/' . $patient->id . '/edit';
        return redirect($patientStoreRedirectUrl);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        $selects = new Selects;
        $titles = $selects->getTitles('titlename', $patient->title);
        $genders = $selects->getGenders('gender', $patient->gender);
        return view('patients.edit', compact("titles"), compact('genders'))->with('patient', $patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'max:25|string|alpha|nullable',
            'firstname' => 'max:255|string|alpha|nullable',
            'lastname' => 'max:255|string|alpha|nullable',
            'gender' => 'max:255|string|alpha|nullable',
            'dob' => 'max:255|date|nullable',
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator->errors());
        }

        $patient = Patient::find($id);
        $patient->title = $request->input('title');
        $patient->firstname = $request->input('firstname');
        $patient->lastname = $request->input('lastname');
        $patient->dob = $request->input('dob');
        $patient->gender = $request->input('gender');
        $patient->save();

        $patientUpdateRedirectUrl = '/patients/' . $patient->id . '/edit';
        return redirect($patientUpdateRedirectUrl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();

        return redirect('home')->with('success', 'Patient deleted.');
    }
}
