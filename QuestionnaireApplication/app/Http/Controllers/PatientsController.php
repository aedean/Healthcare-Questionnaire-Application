<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserTypes;
use App\Patients;

class PatientsController extends Controller
{
    public $titles = array('Miss', 'Mr', 'Mrs', 'Ms', 'Other');


    public function index()
    {
        $patients = Patients::all();
        return view('patients.index')->with('patients', $patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titles = $this->getTitlesHTML();
        return view('patients.create', compact("titles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //The old values need to be populated for the required to be ok
        $this->validate($request, [
            'username' => 'required',
        ]);

        $usertypeid = UserTypes::where('usertypename', '=', 'Patient')->first();

        $patient = new Patients;
        $patient->username = $request->input('username');
        $patient->usertypeid = $usertypeid->usertypeid;
        $patient->title = $request->input('title');
        $patient->firstname = $request->input('firstname');
        $patient->lastname = $request->input('lastname');
        $patient->dob = $request->input('dob');
        $patient->gender = $request->input('gender');
        $patient->password = bcrypt($request->input('password'));
        $patient->save();

        $patient = Patients::find($patient->id);
        $patientIndexUrl = url('/') . '/patient/' . $patient->id . '/edit';
        return redirect($patientIndexUrl)->with('patient', $patient);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patients::find($id);
        if ($patient)  {
            $patienttype = UserTypes::where('usertypeid', '=', $patient->usertypeid)->first();
            return view('patients.show',  compact('patienttype'))->with('patient', $patient);
        } else {
            return redirect('home')->with('error', 'Resource not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patients::find($id);
        $titles = $this->getTitlesHTML($patient->title);
        $patienttype = $this->getUserTypesHTML($patient->usertypeid);
        return view('patients.edit', compact("titles"), compact('patienttype'))->with('patient', $patient);
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
        //The old values need to be populated for the required to be ok
        $this->validate($request, [
            'usertypeid' => 'required',
            'username' => 'required',
        ]);

        $patient = Patients::find($id);
        $patient->username = $request->input('username');
        $patient->usertypeid = $request->input('usertypeid');
        $patient->title = $request->input('title');
        $patient->firstname = $request->input('firstname');
        $patient->lastname = $request->input('lastname');
        $patient->dob = $request->input('dob');
        $patient->gender = $request->input('gender');
        $patient->save();

        $patient = Patients::find($id);
        $patientIndexUrl = url('/') . '/patient/' . $patient->id . '/edit';
        return redirect($patientndexUrl)->with('patient', $patient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patients::find($id);
        $patient->delete();
        
        $patientsIndexUrl = url('/') . '/patients';
        $patients = Patients::all();
        return redirect($patientsIndexUrl)->with('patients', $patients);
    }

    public function getTitles() 
    {
        return $this->titles;
    }

    public function getTitlesHTML($id = null) 
    {
        $titles = $this->getTitles();
        $titlesHTML = '<select name="title" class="form-control" id="title">';
        $titlesHTML .= '<option value="">Select a title</option>';
        foreach($titles as $title)
        {
            $selected = "";
            if($id == $title) {
                $selected = 'selected="selected"';
            }
            $titlesHTML .= '<option ' . $selected . ' value="' . $title . '">' . $title . '</option>';
        }
        $titlesHTML .= '</select>';
        return $titlesHTML;
    }

    public function getUserTypes()
    {
        return UserTypes::all();
    }

    public function getUserTypesHTML($id)
    {
        $usertypes = $this->getUserTypes();
        $usertypesHTML = '<select name="usertypeid" class="form-control" id="usertypeid">';
        $usertypesHTML .= '<option value="">Select a user type</option>';
        foreach($usertypes as $usertype)
        {
            $selected = "";
            if($id == $usertype->usertypeid) {
                $selected = 'selected="selected"';
            }
            $usertypesHTML .= '<option ' . $selected . ' value="' . $usertype->usertypeid . '">' . $usertype->usertypename . '</option>';
        }
        $usertypesHTML .= '</select>';
        return $usertypesHTML;
    }
}
