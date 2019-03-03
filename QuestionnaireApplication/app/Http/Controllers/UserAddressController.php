<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserAddress;
use Auth;

class UserAddressController extends Controller
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
        return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $user = auth()->user();
            $userid = $user->id;
        } else {
            return redirect('home')->with('success', 'Address created.');
        }
        $this->validate($request, [
            'addressline1'  => 'required',
            'addressline2'  => 'required',
            'city'  => 'required',
            'county'    => 'required',
            'country'   => 'required',
            'postcode'  => 'required'
        ]);

        $useraddress = new UserAddress;
        $useraddress->userid = $userid;
        $useraddress->addressline1 = $request->input('addressline1');
        $useraddress->addressline2 = $request->input('addressline2');
        $useraddress->city = $request->input('city');
        $useraddress->county = $request->input('county');
        $useraddress->country = $request->input('country');
        $useraddress->postcode = $request->input('postcode');
        $useraddress->save();

        return redirect('home')->with('success', 'Address created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $useraddress = UserAddress::find($id);
        return view('address.show')->with('useraddress', $useraddress);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $useraddress = UserAddress::find($id);
        return view('address.edit')->with('useraddress', $useraddress);
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
        $useraddress = UserAddress::find($id);
        $useraddress->delete();
        return redirect('home')->with('success', 'Address deleted.');
    }
}
