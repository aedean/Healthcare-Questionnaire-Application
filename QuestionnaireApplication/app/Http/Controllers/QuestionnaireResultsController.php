<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionnaireResults;
use App\Questions;

class QuestionnaireResultsController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $questionnaireId = session()->get('questionnaire_id');
        $question = session()->get('question');

        $this->validate($request, [
            'answer'    => 'required'
        ]);

        $answer = new QuestionnaireResults;
        $answer->questionnaireid = $questionnaireId;
        $answer->questionid = $questionId;
        $answer->answer = $request->input('answer');
        $answer->languageid = 7;
        $answer->save();

        //if there is a user id set add it and save

    
        var_dump($question);
        die;
        if($request->finish) {
            //notes page
            //return redirect('questionnaires/' . $questionnaireId . '/edit');
        } elseif ($request->next) {
            //next question
            $question =  Questions::where('questionid', '=', $questionId);
            $questionNo = $question->questionnumber + 1;
            $question = Questions::where(['questionnumber', '=', $questionNo],
            ['questionnaireid', '=', $questionnaireId]);
            return redirect('question/' . $questionId)->with('question', $question);
        }
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
        //
    }
}
