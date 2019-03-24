<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionnairesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('questionnaires.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questionnaires.create');
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
            'name'  => 'required'
        ]);
        $questionnaire = new Questionnaires;
        $questionnaire->name = $request->input('name');
        $questionnaire->save();
        return redirect('questioncreation')->with('success', 'Questionnaire name created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //na
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questionnaire = Questionnaires::find($id);
        return view('questionnaires.edit')->with('questionnaire', $questionnaire);
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
            'addressline1'  => 'required',
            'addressline2'  => 'required',
            'city'  => 'required',
            'county'    => 'required',
            'country'   => 'required',
            'postcode'  => 'required'
        ]);
        $useraddress = UserAddress::find($id);
        $useraddress->addressline1 = $request->input('addressline1');
        $useraddress->addressline2 = $request->input('addressline2');
        $useraddress->city = $request->input('city');
        $useraddress->county = $request->input('county');
        $useraddress->country = $request->input('country');
        $useraddress->postcode = $request->input('postcode');
        $useraddress->save();
        return redirect('home')->with('success', 'Address updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questionnaire = Questionnaires::find($id);
        $questionnaire->delete();
        return redirect('home')->with('success', 'Questionnaire deleted.');
    }
}
