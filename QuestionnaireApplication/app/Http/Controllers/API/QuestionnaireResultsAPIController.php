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
        $input = $request->all();
        $validator = Validator::make($input, [
            'questionnaireid' => 'required',
            'result' => 'required'       
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $result = new QuestionnaireResults;
        $result->questionnaireid = $request->input('questionnaireid');
        $result->result = $request->input('result');
        $result->userid = $request->input('userid');
        $result->save();
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