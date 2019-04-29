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
        $questionnaires = Questionnaires::all();
        $questionnaireLanguages = QuestionnaireLanguages::all();
        $questionnaireTags = QuestionnaireTags::all();
        $questionnaires = array(
            'questionnaires' => $questionnaires->toArray(),
            'questionnairetags' => $questionnaireTags->toArray(),
            'questionnairelanguages' => $questionnaireLanguages->toArray()
        );
        return $this->sendResponse($questionnaires, 'Questionnaires retrieved successfully.');
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
        $questionnaire = Questionnaires::find($id);
        if (is_null($questionnaire)) {
            return $this->sendError('Questionnaire not found.');
        }

        /** Questionnaire Vars */
        $questionnaireLanguages = QuestionnaireLanguages::all();
        $questionnaireTags = QuestionnaireTags::all();
        $question = Questions::where('questionnaireid', '=', $id)->get();
        $answer = QuestionAnswers::where('questionnaireid', '=', $id)->get();
        $boundaries = QuestionnaireBoundaries::where('questionnaireid', '=', $id)->get();

        $questionnaire = array(
            'questionnaire' => $questionnaire->toArray(),
            'question' => $question->toArray(),
            'answer' => $answer->toArray(),
            'boundaries' => $boundaries->toArray(),
            'questionnairetags' => $questionnaireTags->toArray(),
            'questionnairelanguages' => $questionnaireLanguages->toArray()
        );
        
        return $this->sendResponse($questionnaire, 'Questionnaire retrieved successfully.');
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
        // $input = $request->all();
        // $validator = Validator::make($input, [
        // ‘title’ => ‘required’,
        // ‘body’ => ‘required’,
        // ]);
        // if($validator->fails()){
        // return $this->sendError('Validation Error.', $validator->errors());
        // }
        // $post = Post::find($id);
        // if (is_null($post)) {
        // return $this->sendError('Post not found.');
        // }
        // $post->title = $input[‘title’];
        // $post->body = $input[‘body’];
        // $post->save();
        // return $this->sendResponse($post->toArray(), 'Post updated successfully.');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        // $post = Post::find($id);
        // if (is_null($post)) {
        // return $this->sendError('Post not found.');
        // }
        // Post::where(‘id’, $post->id)
        // ->update([
        // ‘is_delete’=>'0'
        // ]);
        // return $this->sendResponse($id, 'Tag deleted successfully.');
    }
}