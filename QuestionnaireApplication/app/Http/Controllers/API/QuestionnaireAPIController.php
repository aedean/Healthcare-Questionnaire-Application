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

class QuestionnaireAPIController extends APIBaseController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $questionnaires = Questionnaires::all();
        /** Questionnaire Vars */
        $questionnaireResponse = array();
        foreach($questionnaires as $questionnaire){
            $id = $questionnaire->id;
            //LANGUAGES
            $questionnaireLanguages = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
            $languages = array();
            foreach(Languages::all()->toArray() as $language){
                if(in_array($language['id'], array_column($questionnaireLanguages->toArray(), 'languageid'))){
                    $languages[] = $language['language'];
                }
            }
            //TAGS
            $questionnaireTags = QuestionnaireTags::where('questionnaireid', '=', $id)->get();
            $tags = array();
            foreach(Tags::all()->toArray() as $tag){
                if(in_array($tag['id'], array_column($questionnaireTags->toArray(), 'tagid'))){
                    $tags[] = $tag['tagname'];
                }
            }

            $question = Questions::where('questionnaireid', '=', $id)->get();
            $answer = QuestionAnswers::where('questionnaireid', '=', $id)->get();
            $boundaries = QuestionnaireBoundaries::where('questionnaireid', '=', $id)->get();

            $questionnaireResponse[] = array(
                'questionnaire' => $questionnaire->toArray(),
                'question' => $question->toArray(),
                'answer' => $answer->toArray(),
                'boundaries' => $boundaries->toArray(),
                'languages' =>  $languages,
                'tags'  => $tags
            );
        }

        return $this->sendResponse($questionnaireResponse, 'Questionnaires retrieved successfully.');
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