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
        return view('result.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boundaries.create');
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

        foreach($request->all() as $key => $input) {
            if (strpos($key, 'boundaryname') !== false) {
                $elementno = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
                $boundary = new QuestionnaireBoundaries;
                $boundary->questionnaireid = $questionnaireId;
                $boundary->boundaryname = $request->input('boundaryname' . $elementno);
                $boundary->lowerboundary = $request->input('lowerboundary' . $elementno);
                $boundary->higherboundary = $request->input('higherboundary' . $elementno);
                $boundary->notes = $request->input('notes' . $elementno);
                $boundary->save();
            } 
        }

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

    public function saveAnswers($request, $questionid, $questionnaireId)
    {
        foreach($request->all() as $key => $input) {

            if (preg_match_all("/^[a-zA-Z]{6}[0-9]$/", $key)) {
                $filename = '';
                $answer = new QuestionAnswers; 
                $answer->answer = $request->$key;
                $answer->questionnaireid = $questionnaireId;
                $answer->questionid = $questionid;
                $answer->languageid = 7;
                $answer->answerimage = '';
                $answer->save();
                foreach($request->all() as $inputkey => $inputimage) {
                    if(preg_match_all("/^[a-zA-Z]{11}[0-9]$/", $inputkey)) {
                        $no = (int) filter_var($inputkey, FILTER_SANITIZE_NUMBER_INT);
                        $nomatch = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
                        if($no == $nomatch) {
                            $filename = 'answers/' . $questionnaireId . '/' . $questionid . '/' . $answer->answerid;
                            $filename = Storage::disk('public')->put($filename, $request->$inputkey);
                        }
                    }
                }
                $answer->answerimage = $filename;
                $answer->save();
            } 
        }
    }
}
