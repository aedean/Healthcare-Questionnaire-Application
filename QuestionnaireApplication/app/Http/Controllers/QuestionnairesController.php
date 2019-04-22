<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Questionnaires;
use App\Questions;
use App\Languages;
use App\QuestionnaireLanguages;
use App\QuestionnaireTags;
use App\Tags;

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

        return view('questionnaires.index', compact('questionnaireTags'), compact('questionnaireLanguages'))->with('questionnaires', $questionnaires);
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
        $questionnaire->questionnaireimage = '';
        $questionnaire->save();
        session()->put('questionnaire_id', $questionnaire->id);

        if($request->questionnaireimage) {
            $filename = 'questionnaires/' . $questionnaire->id;
            $filename = Storage::disk('public')->put($filename, $request->questionnaireimage);
        }

        $questionnaire->questionnaireimage = $filename;
        $questionnaire->save();

        $this->addLanguages($request->all(), $questionnaire);
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
        $questionnaire = Questionnaires::find($id);
        session()->put('questionnaire_id', $questionnaire->id);
        $questions = Questions::where('questionnaireid', '=', $id)->get();
        $createLanguagesHTML = $this->getCreateLanguages();
        $firstquestion = "";
        foreach($questions as $question) {
            if($question->questionnumber == 1) {
                $firstquestion = $question;
            }
        }
        return view('questionnaires.show', compact('firstquestion'), compact('createLanguagesHTML'))->with('questionnaires', $questionnaire);
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
        session()->put('questionnaire_id', $questionnaire->id);

        //Get language HTML with langauges already saved checked
        $questionnaireLanguagesObject = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
        $questionnaireLanguages = array();
        foreach($questionnaireLanguagesObject as $language){
            $questionnaireLanguages[] = $language->languageid;
        }
        //Get 
        $questionnaireTagsObject = QuestionnaireTags::where('questionnaireid', '=', $id)->get();
        $questionnaireTags = array();
        foreach($questionnaireTagsObject as $tag){
            $questionnaireTags[] = $tag->tagid;
        }
        $editTagsHTML = $this->getEditTags($questionnaireTags);
        $editLanguagesHTML = $this->getEditLanguages($questionnaireLanguages);

        return view('questionnaires.edit', compact('editTagsHTML'), compact('editLanguagesHTML'))->with('questionnaire', $questionnaire)->with('questions', $questions);
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

        // $questionnaireLanguages = $this->questionnaireLanguagesToArray($id);
        // $requestLanguages = $this->requestLanguagesToArray($request);
    
        $questionnaireLanguages = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
        foreach($questionnaireLanguages as $language) {
            if(in_array($language->languageid, array_values($request->all()))) {
                var_dump($language);
            }
        }

        //get the request languages
        //if they in request but not in questionnaire languages add
        //if they not in request delete them from questionnaire languages

        var_dump(array_keys($request->all()));
        var_dump($request->all());
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

    public function requestLanguagesToArray($request)
    {
        $requestLanguages = array();
        foreach($request->all() as $key => $input) {
            if(strpos($key, 'language')) {
                $requestLanguages[$key] = $input;
            }
        }
        return $requestLanguages;
    }

    public function questionnaireLanguagesToArray($id)
    {
        $questionnaireLanguagesArray = array();
        $questionnaireLanguages = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
        foreach($questionnaireLanguages as $language) {
            var_dump($language->languageid);
            die;
            $questionnaireLanguagesArray[$language->languageid];
        }
        return $questionnaireLanguagesArray;
    }

    /**
     * Add languages to questionnaire languages table
     *
     * @param object
     */
    public function addLanguages($request, $questionnaire)
    {
        foreach($request as $key => $input) {
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
    public function getTags()
    {
        $tags = Tags::all();
        return $tags;
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
     * Create the HTML inputs needed on the edit questionnaire page
     *
     * @param array of questionnaire tags
     * @return string of HTML
     */
    public function getEditTags($questionnaireTags)
    {
        $tags = $this->getTags();
        $editHTML = '';
        foreach($tags as $tag)
        {
            if(in_array($tag->id, $questionnaireTags)) {
                $editHTML .= '<input type="checkbox" name="' . $tag->tagname . '" value="' . $tag->id . '" checked>' . $tag->tagname . '<br>';
            } else {
                $editHTML .= '<input type="checkbox" name="' . $tag->tagname . '" value="' . $tag->id . '">' . $tag->tagname . '<br>';
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
