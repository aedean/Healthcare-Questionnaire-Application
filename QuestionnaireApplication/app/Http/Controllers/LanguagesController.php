<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Languages;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Languages::all();
        return view('languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //na
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
            'language' => 'required',
            'colour' => 'required'
        ]);

        $language = new Languages;
        $language->language = $request->input('language');
        $language->colour = $request->input('colour');
        $language->save();

        $languageIndexUrl = url('/') . '/languages';
        $languages = Languages::all();
        return redirect($languageIndexUrl)->with('languages', $languages);
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
        //na
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
            'colour' => 'required'
        ]);

        $language = Languages::find($id);
        $language->colour = $request->input('colour');
        $language->save();

        $languageIndexUrl = url('/') . '/languages';
        $languages = Languages::all();
        return redirect($languageIndexUrl)->with('languages', $languages);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Languages::find($id);
        $language->delete();

        $languageIndexUrl = url('/') . '/languages';
        $languages = Languages::all();
        return redirect($languageIndexUrl)->with('languages', $languages);
    }
}
