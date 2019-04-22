<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserTypes;
use App\Helpers\Selects;
use App\Validator\Forms;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        $validator = Validator::make($request->all(), [
            'usertypeid' => 'required|int|max:5',
            'title' => 'max:25|string|alpha|nullable',
            'firstname' => 'max:255|string|alpha|nullable',
            'lastname' => 'max:255|string|alpha|nullable',
            'email' => 'max:255|email|nullable|unique:users',
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator->errors());
        }

        $user = User::find($id);
        $user->usertypeid = $request->input('usertypeid');
        $user->title = $request->input('title');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->save();

        $userUpdateRedirectUrl = '/user/' . $id . '/edit';
        return redirect($userUpdateRedirectUrl);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('home')->with('success', 'User deleted.');
    }
}
