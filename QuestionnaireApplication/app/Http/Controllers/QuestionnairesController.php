<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Questionnaires;
use App\Questions;
use App\QuestionnaireLanguages;
use App\QuestionnaireTags;
use App\Helpers\Checkboxes;
use App\Helpers\SaveCheckboxes;
use App\Helpers\SaveImages;

class QuestionnairesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaires = Questionnaires::all();
        $questionnairelanguages = QuestionnaireLanguages::all();
        $questionnairetags = QuestionnaireTags::all();

        return view('questionnaires.index')
            ->with('questionnaires', $questionnaires)
            ->with('questionnairelanguages', $questionnairelanguages)
            ->with('questionnairetags', $questionnairetags);
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
        $questionnaire = Questionnaires::find($id);
        session()->put('questionnaire', $questionnaire);
        $questions = Questions::where('questionnaireid', '=', $id)->get();

        $checkboxes = new Checkboxes;
        $languages = $checkboxes->getLanguages($id);
        $tags = $checkboxes->getTags($id);

        return view('questionnaires.edit')
            ->with('questionnaire', $questionnaire)
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
        $questionnaire = Questionnaire::find($id);
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
