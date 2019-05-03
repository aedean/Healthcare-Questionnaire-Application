<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use App\Questionnaires;
use App\QuestionnaireBoundaries;
use App\QuestionnaireLanguages;
use App\QuestionnaireTags;
use App\Questions;
use App\QuestionnaireResults;
use App\QuestionnaireResultAnswers;
use App\QuestionnaireNotes;
use App\Patient;
use Validator;

class QuestionnaireResultsAPIController extends APIBaseController
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
        $inputs = $request->all();
     
        $validator = Validator::make($inputs, [
            'questionnaireid' => 'required',
            'score' => 'required'       
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $result = new QuestionnaireResults;
        $result->questionnaireid = $inputs['questionnaireid'];
        $result->score = $inputs['score'];
        if(isset($inputs['username'])){
            $user = Patient::where('username', '=', $inputs['username'])->first();
            if($user->id != null){
                $result->userid = $user->id;
            }
        }
        $result->save();

        $resultid = $result->id;

        $note = new QuestionnaireNotes;
        $note->resultid = $resultid;
        $note->note = $inputs['note'];
        $note->save();

        foreach($inputs as $key => $input) {
            if(strpos($key, 'answer') !== false) {
                $answer = new QuestionnaireResultAnswers;
                $answer->resultid = $resultid;
                $answer->answer = $inputs[$key];
                $answer->save();
            }
        }

        return $this->sendResponse($result->toArray(), 'Result created successfully.');
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