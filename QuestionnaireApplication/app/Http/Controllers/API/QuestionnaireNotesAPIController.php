<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use App\Questionnaires;
use App\QuestionnaireBoundaries;
use App\QuestionnaireLanguages;
use App\QuestionnaireTags;
use App\Questions;
use App\QuestionAnswers;
use App\Languages;
use App\Tags;
use Validator;

class QuestionnairesAPIController extends APIBaseController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
    }

    /**
    * Display the specified resource.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
    }

    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'questionnaireid' => 'required',
            'notes' => 'required'       
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $note = new QuestionnaireNotes;
        $note->questionnaireid = $request->input('questionnaireid');
        $note->result = $request->input('notes');
        $note->userid = $request->input('userid');
        $note->save();
        return $this->sendResponse($note->toArray(), 'Note created successfully.');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
    }
}