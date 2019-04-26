<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SystemConfig;
use App\Languages;
use App\Tags;
use App\Helpers\SaveImages;
use Illuminate\Support\Facades\Storage;

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
        $inputtype = 'input';
        if($attribute->attributename == 'Application Logo') {
            $inputtype = 'image';
        }
        return view('systemconfiguration.edit', compact('attribute'))
            ->with('inputtype', $inputtype);
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
        $attribute = SystemConfig::find($id);
        if($attribute->attributename == 'Application Logo') {
            if($request->image) {
                if($attribute->attributevalue) {
                    if(Storage::disk('public')->has($attribute->attributevalue)) {
                        Storage::disk('public')->delete($attribute->attributevalue);
                    }
                    $filename = 'application/logo';
                    $filename = Storage::disk('public')->put($filename, $request->image);
                    $attribute->attributevalue = $filename;
                    $attribute->save();
                } 
            }
        } else {
            $attribute->attributevalue = $request->input('attributevalue');
            $attribute->save();
        }

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
