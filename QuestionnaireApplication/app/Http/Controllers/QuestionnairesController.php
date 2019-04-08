<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionnaires;
use App\Questions;
use App\Languages;
use App\QuestionnaireLanguages;
use App\QuestionnaireTags;

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
        $questionnaireLanguages = QuestionnaireLanguages::all();
        $questionnaireTags = QuestionnaireTags::all();
        $request->session()->put('questionnaire_id', $questionnaire->id);
        return view('questionnaires.index', compact('questionnaireTags'), compact('questionnaireLanguages'))->with('questionnaires', $questionnaires);
    }

    public function allQuestionnaireLanguagesToArray()
    {
        $questionnaireTags = QuestionnaireTags::all();
        $questionnaireTagsArray = "";
        foreach($questionnaireTags as $questionnaireTag) {
            $questionnaireTagsArray[$questionnaireTag->questionnaireId] = $questionnaireTag->languageId;
        }
        return $questionnaireTagsArray;
    }

    public function allQuestionnaireTagsToArray()
    {
        $questionnaireTags = QuestionnaireTags::all();
        $questionnaireTagsArray = "";
        foreach($questionnaireTags as $questionnaireTag) {
            $questionnaireTagsArray[$questionnaireTag->questionnaireId] = $questionnaireTag->languageId;
        }
        return $questionnaireTagsArray;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $createLanguagesHTML = $this->getCreateLanguages();
        return view('questionnaires.create')->with('createLanguagesHTML', $createLanguagesHTML);
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
        $questionnaire->save();
        $request->session()->put('questionnaire_id', $questionnaire->id);

        $this->addLanguages($request->all());
        return redirect('question/create')->with('success', 'Questionnaire name created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questionnaires = Questionnaires::find($id);
        $questions = Questions::where('questionnaireid', '=', $id)->get();
        $firstquestion = "";
        foreach($questions as $question) {
            if($question->questionnumber == 1) {
                $firstquestion = $question;
            }
        }
        return view('questionnaires.show', compact('firstquestion'))->with('questionnaires', $questionnaires);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Get all all questions assosiated with the questionnaire
        $questionnaire = Questionnaires::find($id);
        $questions = Questions::where('questionnaireid', '=', $id)->get();

        //Get language HTML with langauges already saved checked
        $questionnaireLanguagesObject = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
        $questionnaireLanguages = array();
        foreach($questionnaireLanguagesObject as $language){
            $questionnaireLanguages[] = $language->languageid;
        }
        $editLanguagesHTML = $this->getEditLanguages($questionnaireLanguages);
        return view('questionnaires.edit', compact('questions'), compact('editLanguagesHTML'))->with('questionnaire', $questionnaire);
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

        $questionnaireLanguages = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
        //loop over request
        //if the id of the language is not in qlnags add it
        //if 
        $requestLanguages = $this->requestLanguageToArray($request);
        var_dump($requestLanguages);
        var_dump(array_values($requestLanguages));
        // foreach($questionnaireLanguages as $language){
        //     var_dump($language);
        //     //in table not request delete
        //     //in request not in table add
        //     if(!in_array($language->id, $requestLanguages)) {
        //          //delete it
        //     } elseif() {

        //     }
        //     // elseif (in_array(array_column(''))) {

        //     // }
        // }
        // $questionnaireLanguagesArray = $this->questionnaireLanguagesToArray($id);
        // foreach($requestLanguages as $language => ) {
        //     if(!in_array($language, $questionnaireLanguagesArray)) {
                
        //     }
        // }

        die;

        $this->updateLanguages($request->all());
        $questions = Questions::where('questionnaireid', '=', $id)->get();
        return view('questionnaires.edit', compact('questions'))->with('questionnaire', $questionnaire);
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
        $questionnaires = Questionnaires::all();
        return view('questionnaires.index', compact('questionnaires'))->with('success', 'Questionnaire deleted.');
    }

    public function requestLanguagesToArray($request)
    {
        $requestLanguages = array();
        foreach($request->all() as $key => $input) {
            $requestLanguages[$key] = $input;
        }
        return $requestLanguages;
    }

    public function questionnaireLanguagesToArray($id)
    {
        $questionnaireLanguagesArray = array();
        $questionnaireLanguages = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
        foreach($questionnaireLanguages as $language) {
            $questionnaireLanguagesArray[$language->id];
        }
        return $questionnaireLanguagesArray;
    }

    /**
     * Add languages to questionnaire languages table
     *
     * @param object
     */
    public function addLanguages($request)
    {
        foreach($request->all() as $key => $input) {
            if (strpos($key, 'language') !== FALSE) { 
                $questionnaireLanguage = new QuestionnaireLanguages;
                $questionnaireLanguage->questionnaireid = $questionnaire->id;
                $questionnaireLanguage->languageid = $input;
                $questionnaireLanguage->save();
            }
        }
    }

    /**
     * Add or remove languages from the questionnaire languages table
     *
     * @param object
     */
    public function updateLanguages($request)
    {
        foreach($request->all() as $key => $input) {
            if (strpos($key, 'language') !== FALSE) { 
                $questionnaireLanguage = new QuestionnaireLanguages;
                $questionnaireLanguage->questionnaireid = $questionnaire->id;
                $questionnaireLanguage->languageid = $input;
                $questionnaireLanguage->save();
            }
        }
    }

    /**
     * Get all languages available
     *
     * @return object
     */
    public function getLanguages()
    {
        $languages = Languages::all();
        return $languages;
    }

    /**
     * Create the HTML inputs needed on the edit questionnaire page
     *
     * @param array of questionnaire languages
     * @return string of HTML
     */
    public function getEditLanguages($questionnaireLanguages)
    {
        $languages = $this->getLanguages();
        $editHTML = '';
        foreach($languages as $language)
        {
            if(in_array($language->id, $questionnaireLanguages)) {
                $editHTML .= '<input type="checkbox" name="' . $language->language . '" value="' . $language->id . '" checked>' . $language->language . '<br>';
            } else {
                $editHTML .= '<input type="checkbox" name="' . $language->language . '" value="' . $language->id . '">' . $language->language . '<br>';
            }
        }
        return $editHTML;
    }

    /**
     * Create the HTML inputs needed on the create questionnaire page
     *
     * @return string of HTML
     */
    public function getCreateLanguages()
    {
        $languages = $this->getLanguages();
        $editHTML = '';
        $languageCount = 1;
        foreach($languages as $language)
        {
            $editHTML .= '<input type="checkbox" name="language' . $languageCount . '" value="' . $language->id . '">' . $language->language . '<br>';
            $languageCount++;
        }
        return $editHTML;
    }
}
