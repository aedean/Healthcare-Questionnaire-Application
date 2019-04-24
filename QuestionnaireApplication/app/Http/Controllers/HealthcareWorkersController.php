<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HealthcareWorkers;
use App\UserAddress;

class HealthcareWorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $healthcareWorkers = HealthcareWorkers::all();
        return view('healthcareworkers.index', compact('healthcareWorkers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('healthcareworkers.create');
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
            'title' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'landline' => 'required',
            'company' => 'required',
            'addressline1' => 'required',
            'addressline2' => 'required',
            'city' => 'required',
            'county' => 'required',
            'country' => 'required',
            'postcode' => 'required'
        ]);

        $healthcareWorker = new HealthcareWorkers;
        $healthcareWorker->title = $request->input('title');
        $healthcareWorker->firstname = $request->input('firstname');
        $healthcareWorker->lastname = $request->input('lastname');
        $healthcareWorker->gender = $request->input('gender');
        $healthcareWorker->mobile = $request->input('mobile');
        $healthcareWorker->landline = $request->input('landline');
        $healthcareWorker->company = $request->input('company');
        $healthcareWorker->save();

        $useraddress = new UserAddress;
        $useraddress->userid = $healthcareWorker->id;
        $useraddress->addressline1 = $request->input('addressline1');
        $useraddress->addressline2 = $request->input('addressline2');
        $useraddress->city = $request->input('city');
        $useraddress->county = $request->input('county');
        $useraddress->country = $request->input('country');
        $useraddress->postcode = $request->input('postcode');
        $useraddress->save();

        $healthcareWorkersUrl = url('/') . '/healthcareworkers';
        $healthcareWorkers = HealthcareWorkers::all();
        return redirect($healthcareWorkersUrl)->with('healthcareWorkers', $healthcareWorkers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $healthcareWorkers = HealthcareWorkers::all();
        return view('healthcareworkers.show', compact('healthcareWorkers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $healthcareWorker = HealthcareWorkers::find($id);
        $userAddress = UserAddress::where('userid', '=', $id)->get();
        $userAddress = $userAddress->first();
        return view('healthcareworkers.edit', compact('healthcareWorker'), compact('userAddress'));
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
            'title' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'landline' => 'required',
            'company' => 'required',
            'addressline1' => 'required',
            'addressline2' => 'required',
            'city' => 'required',
            'county' => 'required',
            'country' => 'required',
            'postcode' => 'required'
        ]);

        $healthcareWorker = HealthcareWorkers::find($id);
        $healthcareWorker->title = $request->input('title');
        $healthcareWorker->firstname = $request->input('firstname');
        $healthcareWorker->lastname = $request->input('lastname');
        $healthcareWorker->gender = $request->input('gender');
        $healthcareWorker->mobile = $request->input('mobile');
        $healthcareWorker->landline = $request->input('landline');
        $healthcareWorker->company = $request->input('company');
        $healthcareWorker->save();

        $userAddress = UserAddress::where('userid', '=', $id)->get();
        $useraddress = $userAddress->first();
        $useraddress->userid = $healthcareWorker->id;
        $useraddress->addressline1 = $request->input('addressline1');
        $useraddress->addressline2 = $request->input('addressline2');
        $useraddress->city = $request->input('city');
        $useraddress->county = $request->input('county');
        $useraddress->country = $request->input('country');
        $useraddress->postcode = $request->input('postcode');
        $useraddress->save();

        $healthcareWorkersUrl = url('/') . '/healthcareworkers';
        $HealthcareWorkers = HealthcareWorkers::all();
        return redirect($healthcareWorkersUrl)->with('healthcareWorkers', $healthcareWorkers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $healthcareWorker = HealthcareWorkers::find($id);
        $healthcareWorker->delete();

        $healthcareWorkersUrl = url('/') . '/healthcareworkers';
        $healthcareWorkers = HealthcareWorkers::all();
        return redirect($healthcareWorkersUrl)->with('healthcareWorkers', $healthcareWorkers);
    }
}
