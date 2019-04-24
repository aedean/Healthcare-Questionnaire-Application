<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionnaireBoundaries;

class QuestionnaireBoundariesController extends Controller
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
        $questionnaireId = session()->get('questionnaire')->id;

        $this->validate($request, [
            'boundaryname'  => 'required',
            'lowerboundary'  => 'required',
            'higherboundary'  => 'required',
            'notes'    => 'required'
        ]);

        $boundary = new QuestionnaireBoundaries;
        $boundary->questionnaireid = $questionnaireId;
        $boundary->boundaryname = $request->input('boundaryname');
        $boundary->lowerboundary = $request->input('lowerboundary');
        $boundary->higherboundary = $request->input('higherboundary');
        $boundary->notes = $request->input('notes');
        $boundary->save();

        return redirect('/questionnaires/' . $questionnaireId . '/edit');
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
        //
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
        $questionnaireId = session()->get('questionnaire')->id;

        $this->validate($request, [
            'boundaryname'  => 'required',
            'lowerboundary'  => 'required',
            'higherboundary'  => 'required',
            'notes'    => 'required'
        ]);

        $boundary = QuestionnaireBoundaries::find($id);
        $boundary->boundaryname = $request->input('boundaryname');
        $boundary->lowerboundary = $request->input('lowerboundary');
        $boundary->higherboundary = $request->input('higherboundary');
        $boundary->notes = $request->input('notes');
        $boundary->save();

        return redirect('/questionnaires/' . $questionnaireId . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boundary = QuestionnaireBoundaries::find($id);
        $boundary->delete();
        return redirect('/questionnaires/' . $questionnaireId . '/edit');
    }
}
