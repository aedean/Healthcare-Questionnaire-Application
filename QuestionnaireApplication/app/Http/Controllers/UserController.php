<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserTypes;

class UserController extends Controller
{
    public $titles = array('Miss', 'Mr', 'Mrs', 'Ms', 'Other');
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $titles = $this->getTitlesHTML();
        $usertype = $this->getUserTypesHTML();
        $user = User::find($id);
        return view('user.edit', compact("titles"), compact('usertype'))->with('user', $user);
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
        // $this->validate($request, [
        //     'addressline1'  => 'required',
        //     'addressline2'  => 'required',
        //     'city'  => 'required',
        //     'county'    => 'required',
        //     'country'   => 'required',
        //     'postcode'  => 'required'
        // ]);

        // $useraddress = UserAddress::find($id);
        // $useraddress->addressline1 = $request->input('addressline1');
        // $useraddress->addressline2 = $request->input('addressline2');
        // $useraddress->city = $request->input('city');
        // $useraddress->county = $request->input('county');
        // $useraddress->country = $request->input('country');
        // $useraddress->postcode = $request->input('postcode');
        // $useraddress->save();

        // return redirect('home')->with('success', 'Address updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
