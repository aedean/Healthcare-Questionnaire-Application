<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserTypes;
use App\UserAddress;

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
            $useraddresses = UserAddress::where('userid', '=', $id)->get();
            return view('user.show', compact('useraddresses'), compact('usertype'))->with('user', $user);
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
        $titles = $this->getTitlesHTML($user->title);
        $usertype = $this->getUserTypesHTML($user->usertypeid);
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
        //
    }

    public function getTitles() 
    {
        return $this->titles;
    }

    public function getTitlesHTML($id) 
    {
        $titles = $this->getTitles();
        $titlesHTML = '<select name="title" class="form-control" id="title">';
        foreach($titles as $title)
        {
            $selected = "";
            if($id == $title) {
                $selected = 'selected="selected"';
            }
            $titlesHTML .= '<option ' . $selected . ' value="' . $title . '">' . $title . '</option>';
        }
        $titlesHTML .= '</select>';
        return $titlesHTML;
    }

    public function getUserTypes()
    {
        return UserTypes::all();
    }

    public function getUserTypesHTML($id)
    {
        $usertypes = $this->getUserTypes();
        $usertypesHTML = '<select name="usertypeid" class="form-control" id="usertypeid">';
        foreach($usertypes as $usertype)
        {
            $selected = "";
            if($id == $usertype->usertypeid) {
                $selected = 'selected="selected"';
            }
            $usertypesHTML .= '<option ' . $selected . ' value="' . $usertype->usertypeid . '">' . $usertype->usertypename . '</option>';
        }
        $usertypesHTML .= '</select>';
        return $usertypesHTML;
    }
}
