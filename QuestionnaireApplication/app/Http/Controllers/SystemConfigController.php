<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SystemConfig;
use App\Languages;
use App\Tags;

class SystemConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = SystemConfig::all();
        return view('systemconfiguration.index', compact('attributes'));
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
        //na
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attribute = SystemConfig::find($id);
        return view('systemconfiguration.show', compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = SystemConfig::find($id);
        return view('systemconfiguration.edit', compact('attribute'));
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
            'attributevalue' => 'required'
        ]);

        $attribute = SystemConfig::find($id);
        $attribute->attributevalue = $request->input('attributevalue');
        $attribute->save();

        $attributes = SystemConfig::all();
        return view('systemconfiguration.index', compact('attributes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = SystemConfig::find($id);
        $attribute->delete();
        return redirect('/attributes')->with('success', 'Deleted.');
    }
}
