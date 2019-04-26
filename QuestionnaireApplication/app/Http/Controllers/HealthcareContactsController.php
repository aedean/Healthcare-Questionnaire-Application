<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HealthcareContacts;
use App\UserAddress;

class HealthcareContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $healthcarecontacts = HealthcareContacts::all();
        return view('healthcarecontacts.index', compact('healthcarecontacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('healthcarecontacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'landline' => 'required',
            'company' => 'required'
        ]);

        $healthcarecontact = new HealthcareContacts;
        $healthcarecontact->name = $request->input('name');
        $healthcarecontact->landline = $request->input('landline');
        $healthcarecontact->mobile = $request->input('mobile');
        $healthcarecontact->company = $request->input('company');
        $healthcarecontact->save();

        $useraddress = new UserAddress;
        $useraddress->userid = $healthcarecontact->id;
        $useraddress->addressline1 = $request->input('addressline1');
        $useraddress->addressline2 = $request->input('addressline2');
        $useraddress->city = $request->input('city');
        $useraddress->county = $request->input('county');
        $useraddress->country = $request->input('country');
        $useraddress->postcode = $request->input('postcode');
        $useraddress->save();

        $healthcarecontactsUrl = url('/') . '/healthcarecontacts';
        $healthcarecontacts = HealthcareContacts::all();
        return redirect($healthcarecontactsUrl)->with('healthcarecontacts', $healthcarecontacts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $healthcarecontacts = HealthcareContacts::all();
        return view('healthcarecontacts.show', compact('healthcarecontacts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $healthcarecontact = HealthcareContacts::find($id);
        $useraddress = UserAddress::where('userid', '=', $id)->get();
        $useraddress = $useraddress->first();
        return view('healthcarecontacts.edit', compact('healthcarecontact'), compact('useraddress'));
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
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'landline' => 'required',
            'company' => 'required',
            'postcode' => 'required'
        ]);

        $healthcarecontact = HealthcareContacts::find($id);
        $healthcarecontact->name = $request->input('name');
        $healthcarecontact->mobile = $request->input('mobile');
        $healthcarecontact->landline = $request->input('landline');
        $healthcarecontact->company = $request->input('company');
        $healthcarecontact->save();

        $useraddress = UserAddress::where('userid', '=', $id)->get();
        $useraddress = $useraddress->first();
        $useraddress->userid = $healthcarecontact->id;
        $useraddress->addressline1 = $request->input('addressline1');
        $useraddress->addressline2 = $request->input('addressline2');
        $useraddress->city = $request->input('city');
        $useraddress->county = $request->input('county');
        $useraddress->country = $request->input('country');
        $useraddress->postcode = $request->input('postcode');
        $useraddress->save();

        $healthcarecontactsurl = url('/') . '/healthcarecontacts';
        $healthcarecontacts = HealthcareContacts::all();
        return redirect($healthcarecontactsurl)->with('healthcarecontacts', $healthcarecontacts);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $healthcarecontact = HealthcareContacts::find($id);
        $healthcarecontact->delete();

        $healthcarecontactsurl = url('/') . '/healthcarecontacts';
        $healthcarecontacts = HealthcareContacts::all();
        return redirect($healthcarecontactsurl)->with('healthcarecontacts', $healthcarecontacts);
    }
}
