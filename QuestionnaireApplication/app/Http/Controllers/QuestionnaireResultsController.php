<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionnaireResults;
use App\QuestionnaireResultAnswers;
use App\QuestionnaireNotes;
use App\Patient;

class QuestionnaireResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = QuestionnaireResults::all();
        return view('questionnaireresults.index')
            ->with('results', $results);
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
        $results = QuestionnaireResults::find($id);
        $answers = QuestionnaireResultAnswers::where('resultid', '=', $id)->get();
        $resultnote = QuestionnaireNotes::where('resultid', '=', $id)->first();
        $patients = Patient::find($results->userid);
        return view('questionnaireresults.show')
            ->with('results', $results)
            ->with('answers', $answers)
            ->with('patient', $patients)
            ->with('resultnote', $resultnote);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = QuestionnaireResults::find($id);
        $result->delete();

        $answers = QuestionnaireResultAnswers::where('resultid', '=', $id)->get();
        foreach($answers as $answer) {
            $answer->delete();
        }

        $resultnotes = QuestionnaireNotes::where('resultid', '=', $id)->get();
        foreach($resultnotes as $note) {
            $note->delete();
        }

        redirect('/questionnaireresults');
    }
}
