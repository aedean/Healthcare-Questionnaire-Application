<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserTypes;

class UsersController extends Controller
{
    public $titles = array('Miss', 'Mr', 'Mrs', 'Ms', 'Other');
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
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
        return view('users.edit', compact("titles"), compact('usertype'))->with('user', $user);
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
            'title' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'dob' => 'required',
            'email' => 'required'
        ]);

        $user = User::find($id);
        $user->usertypeid = $request->input('usertypeid');
        $user->title = $request->input('title');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->dob = $request->input('dob');
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
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('success', 'User deleted.');
    }

    /**
     * Search for requested field.
     *
     * @param  $query  $query
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        var_dump($request);
        die;
        $users = User::where('title', 'LIKE', "%$request->search%")->get();
        return view('users.search');
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
