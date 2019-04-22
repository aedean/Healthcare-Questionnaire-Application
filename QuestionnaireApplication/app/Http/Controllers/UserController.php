<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserTypes;
use App\UserAddress;
use App\Helpers\Selects;

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
        $user = User::find($id);
        if ($user)  {
            $usertype = UserTypes::where('usertypeid', '=', $user->usertypeid)->first();
            return view('user.show', compact('usertype'))->with('user', $user);
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
        $user = User::find($id);
        $selects = new Selects;
        $titles = $selects->getTitles('titlename', $user->title);
        $usertype = $selects->getUserTypes('usertypeid', $user->usertypeid);
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
        //The old values need to be populated for the required to be ok
        $this->validate($request, [
            'usertypeid' => 'required',
            'username' => 'required',
        ]);

        $user = User::find($id);
        $user->usertypeid = $request->input('usertypeid');
        $user->title = $request->input('title');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->save();

        return redirect('home')->with('success', 'User updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usertype = User::find($id);
        $usertype->delete();

        return redirect('home')->with('success', 'User deleted.');
    }
}
