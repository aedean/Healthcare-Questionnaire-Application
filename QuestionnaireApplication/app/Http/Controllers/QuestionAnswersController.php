<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SaveImages;
use App\QuestionAnswers;
use App\Questions;

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
        $questionnaireId = session()->get('questionnaire')->id;
        $question = session()->get('question');
        $questionid = $question->questionid;

        $this->validate($request, [
            'answer'    => 'required',
            'answerimage'   => 'required'
        ]);

        $answer = new QuestionAnswers;
        $answer->questionnaireid = $questionnaireId;
        $answer->questionid = $questionid;
        $answer->answer = $request->input('answer');
        $answer->languageid = $question->languageid;
        $answer->answerimage = '';
        $answer->save();
        
        $saveImages = new SaveImages;
        $saveImages->saveImage($request, 'answerimage', $answer, $questionnaireId, $questionid, $answer->answerid);

        return redirect('question/' . $questionid . '/edit');
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
        $question = session()->get('question');
        $questionid = $question->questionid;

        $this->validate($request, [
            'answer'    => 'required'
        ]);

        $answer = QuestionAnswers::find($id);
        $answer->answer = $request->input('answer');
        $answer->languageid = $question->languageid;
        $answer->save();
        
        if($request->answerimage) {
            $saveImages = new SaveImages;
            $saveImages->saveImage($request, 'answerimage', $answer, $questionnaireId, $questionid, $answer->answerid);
        }

        return redirect('question/' . $questionid . '/edit');
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
        return redirect(url()->previous());
    }
}
