<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserTypes;
use App\UserAccess;
use App\Helpers\Checkboxes;
use App\Helpers\SaveCheckboxes;
use App\ApplicationAccess;

class UserTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usertypes = UserTypes::all();
        return view('usertypes.index', compact('usertypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $checkboxes = new Checkboxes;
        $applicationAccess = $checkboxes->getApplicationAccess();
        return view('usertypes.create', compact('applicationAccess'));
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
            'usertypename' => 'required'
        ]);

        $usertype = new UserTypes;
        $usertype->usertypename = $request->input('usertypename');
        $usertype->save();

        $checkboxes = new SaveCheckboxes;
        $checkboxes->storeCheckboxes($request, 'UserAccess', 'useraccess', 'usertypeid', $usertype->usertypeid, 'pageurlid');

        $usertypeIndexUrl = url('/') . '/usertypes';
        $usertypes = UserTypes::all();
        return redirect($usertypeIndexUrl)->with('usertypes', $usertypes);
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
        $usertype = UserTypes::find($id);
        $checkboxes = new Checkboxes;
        $applicationAccess = $checkboxes->getApplicationAccess($id);
        return view('usertypes.edit', compact('usertype'), compact('applicationAccess'));
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
            'usertypename' => 'required'
        ]);

        $usertype = UserTypes::find($id);
        $usertype->usertypename = $request->input('usertypename');
        $usertype->save();

        $checkboxes = new SaveCheckboxes;
        $checkboxes->updateCheckboxes($request, 'useraccess', 'UserAccess', $id, 'usertypeid', 'pageurlid');

        $usertypeIndexUrl = url('/') . '/usertypes/' . $id . '/edit';
        return redirect($usertypeIndexUrl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usertype = UserTypes::find($id);
        $usertype->delete();

        $usertypeIndexUrl = url('/') . '/usertypes';
        $usertypes = UserTypes::all();
        return redirect($usertypeIndexUrl)->with('usertypes', $usertypes);
    }
}
