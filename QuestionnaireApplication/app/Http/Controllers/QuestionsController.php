<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\QuestionAnswers;

class QuestionsController extends Controller
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
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $questionnaireId = $request->session()->get('questionnaire_id');

        $this->validate($request, [
            // 'questionnumber'  => 'required',
            // 'languageid'  => 'required',
            'question'    => 'required',
            // 'questionimage'   => 'required',
            // 'answertype'  => 'required'
        ]);
        
        if($request->questionimage) {
            $request->questionimage->storeAs('uploads/questionnaires/' . $questionnaireId . '/questions/', $request->questionimage->getClientOriginalName());
            $filename = 'uploads/questionnaires/' . $questionnaireId . '/questions/' . $request->questionimage->getClientOriginalName();
        }

        $questions = new Questions;
        $questions->questionnaireid = $questionnaireId;
        $questions->questionnumber = 5;
        $questions->languageid = 7;
        $questions->question = $request->input('question');
        $questions->questionimage = $filename;
        $questions->answertype = 'here';
        $questions->save();
        
        if($request->answer) {
            $answers = new QuestionAnswers; 
            $answers->questionnaireid = $questionnaireId;
            $answers->questionid = $questions->questionid;
            $answers->answer = $request->answer;
            $answers->languageid = 7;
            $answers->save();
        }

        if($request->finish) {
            return redirect('questionnaires/' . $questionnaireId . '/edit');
        } elseif ($request->submit) {
            return view('question.create');
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
        $question = Questions::find($id);
        $answers = QuestionAnswers::where('questionid', '=', $id)->get();
        return view('question.show', compact('answers'))->with('question', $question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Questions::find($id);
        $answers = QuestionAnswers::where('questionid', '=', $id)->get();
        return view('question.edit', compact('answers'))->with('question', $question);
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
            'questionnumber'  => 'required',
            'languageid'  => 'required',
            'question'    => 'required',
            'country'   => 'required',
            'answertype'  => 'required'
        ]);
        $question = Questions::find($id);
        $question->questionnumber = $request->input('questionnumber');
        $question->languageid = $request->input('languageid');
        $question->question = $request->input('question');
        $question->questionimage = $request->input('questionimage');
        $question->answertype = $request->input('answertype');
        $question->save();

        if($request->answer) {
            $answers = QuestionAnswers::id(); 
            $answers->answer = $request->answer;
            $answers->languageid = 7;
            $answers->save();
        }

        return URL::previous();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questions = Questions::find($id);
        $questions->delete();
        return redirect('home')->with('success', 'Question deleted.');
    }
}
