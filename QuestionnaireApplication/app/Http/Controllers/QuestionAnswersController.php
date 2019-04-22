<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\QuestionAnswers;
use App\Questionnaires;
use Illuminate\Support\Facades\Storage;
use App\QuestionnaireLanguages;
use App\Languages;

class QuestionAnswersController extends Controller
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
        $questionnaireId = session()->get('questionnaire_id');
        $questionId = session()->get('question_id');

        $this->validate($request, [
            'answer'    => 'required',
            'answerimage'   => 'required'
        ]);

        $answer = new QuestionAnswers;
        $answer->questionnaireid = $questionnaireId;
        $answer->questionid = $questionId;
        $answer->answer = $request->input('answer');
        $answer->languageid = 7;
        $answer->answerimage = '';
        $answer->save();
        
        if($request->answerimage) {
            $filename = 'answers/' . $questionnaireId . '/' . $questionId;
            $filename = Storage::disk('public')->put($filename, $request->answerimage);
            $answer->answerimage = $filename;
            $answer->save();
        }

        $question = Questions::find($questionId);
        return redirect('question/' . $questionId . '/edit')->with('question', $question);
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
        $questionnaireId = session()->get('questionnaire_id');
        $questionId = session()->get('question_id');

        $this->validate($request, [
            'answer'    => 'required'
        ]);

        $answer = QuestionAnswers::find($id);
        $answer->answer = $request->input('answer');
        $answer->save();
        
        if($request->answerimage) {
            if($answer->answerimage) {
                if(Storage::disk('public')->has($answer->answerimage)) {
                    Storage::disk('public')->delete($answer->answerimage);
                }
            } 
            $filename = 'answers/' . $questionnaireId . '/' . $questionId;
            $filename = Storage::disk('public')->put($filename, $request->answerimage);
            $answer->answerimage = $filename;
            $answer->save();
        }

        $question = Questions::find($questionId);
        return redirect('question/' . $questionId . '/edit')->with('question', $question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = QuestionAnswers::find($id);
        $answer->delete();
        $questionId = session()->get('question_id');
        $question = Questions::find($questionId);
        return redirect('question/' . $questionId . '/edit')->with('question', $question);
    }
}
