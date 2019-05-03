<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use App\HealthcareContacts;
use App\UserAddress;
use Validator;

class HealthcareContactsAPIController extends APIBaseController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $healthcareContactsArray = array();
        $healthcareContacts = HealthcareContacts::all();
        foreach($healthcareContacts as $contact) {
            $address = UserAddress::where('userid', '=', $contact->id)->get()->toArray();
            $healthcareContactsArray[] = array(
                $contact,
                $address
            );
        }
        return $this->sendResponse($healthcareContactsArray, 'Healthcare Contacts retrieved successfully.');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    }

    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
    }

    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    }
}