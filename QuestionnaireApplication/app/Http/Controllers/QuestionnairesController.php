<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Questionnaires;
use App\QuestionnaireBoundaries;
use App\Questions;
use App\QuestionnaireLanguages;
use App\Tags;
use App\Languages;
use App\QuestionnaireTags;
use App\Helpers\Checkboxes;
use App\Helpers\SaveCheckboxes;
use App\Helpers\SaveImages;
use App\Helpers\SetImagesCookie;
use App\QuestionAnswers;
use Cookie;
use Session;

class QuestionnairesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imageCookie = new SetImagesCookie();
        $imageCookie->createServiceWorker();

        $questionnaires = Questionnaires::all();
        $languages = Languages::all();

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

            $questionnaireResponse[] = array(
                'questionnaire' => $questionnaire->toArray(),
                'languages' =>  $languages,
                'tags'  => $tags
            );
        }

        return view('questionnaires.index')
            ->with('questionnaires', $questionnaireResponse);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $checkboxes = new Checkboxes;
        $languages = $checkboxes->getLanguages();
        $tags = $checkboxes->getTags();
        return view('questionnaires.create')
            ->with('languages', $languages)
            ->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required'
        ]);

        $questionnaire = new Questionnaires;
        $questionnaire->name = $request->input('name');
        $questionnaire->questionnaireimage = '';
        $questionnaire->save();

        $checkboxes = new SaveCheckboxes;
        $checkboxes->storeCheckboxes($request, 'QuestionnaireLanguages', 'language', 'questionnaireid', $questionnaire->id, 'languageid');
        $checkboxes->storeCheckboxes($request, 'QuestionnaireTags', 'tag', 'questionnaireid', $questionnaire->id, 'tagid');

        if($request->questionnaireimage) {
            $saveImages = new SaveImages;
            $saveImages->saveImage($request, 'questionnaireimage', $questionnaire, $questionnaire->id);
        }

        $request->session()->put('questionnaire', $questionnaire);
        return redirect('question/create')->with('success', 'Questionnaire created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        session_start();
        $questionnaire = Questionnaires::find($id);
        $questions = Questions::where('questionnaireid', '=', $id)->get();
        $count = (int)count($questions);
        
        $_SESSION["questionnaire"] = $questionnaire->toArray();
        $_SESSION["questionno"] = 1;
        $_SESSION["questioncount"] = $count;

        //languages for select
        $questionnairelanguages = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
        $questionnairelanguages = $questionnairelanguages->toArray();
        $questionnairelanguagesarray = array();
        foreach(Languages::all() as $language) {
            if(in_array($language->id, array_column($questionnairelanguages, 'languageid'))){
                $questionnairelanguagesarray[] = $language->language;
            }
        }

        //first question
        $firstquestion = 0;
        foreach($questions as $question) {
            if($question->questionnumber == 1) {
                $firstquestion = $question->questionid;
            }
        }

        return view('questionnaires.show')
            ->with('questionnaire', $questionnaire)
            ->with('languages', $questionnairelanguagesarray)
            ->with('firstquestionid', $firstquestion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questionnaire = Questionnaires::find($id);
        session()->put('questionnaire', $questionnaire);
        $questions = Questions::where('questionnaireid', '=', $id)->get();

        $checkboxes = new Checkboxes;
        $languages = $checkboxes->getLanguages($id);
        $tags = $checkboxes->getTags($id);
        $boundaries = QuestionnaireBoundaries::where('questionnaireid', '=', $id)->get();

        return view('questionnaires.edit')
            ->with('questionnaire', $questionnaire)
            ->with('boundaries', $boundaries)
            ->with('questions', $questions)
            ->with('languages', $languages)
            ->with('tags', $tags);
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
            'name'  => 'required'
        ]);
        $questionnaire = Questionnaires::find($id);
        $questionnaire->name = $request->input('name');
        $questionnaire->save();

        $checkboxes = new SaveCheckboxes;
        $checkboxes->updateCheckboxes($request, 'language', 'QuestionnaireLanguages', $id, 'questionnaireid', 'languageid');
        $checkboxes->updateCheckboxes($request, 'tag', 'QuestionnaireTags', $id, 'questionnaireid', 'tagid');

        if($request->questionnaireimage) {
            $saveImages = new SaveImages;
            $saveImages->saveImage($request, 'questionnaireimage', $questionnaire, $questionnaire->id);
        }

        return redirect('/questionnaires/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questionnaire = Questionnaires::find($id);
        $questionnaire->delete();

        $questions = Questions::where('questionnaireid', '=', $id);
        foreach($questions as $question) {
            $question->delete();
        }

        $questionanswers = QuestionAnswers::where('questionnaireid', '=', $id)->get();
        foreach($questionanswers as $answer) {
            $answer->delete();
        }

        return redirect('/questionnaires')->with('success', 'Questionnaire deleted.');
    }
}
