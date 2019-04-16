<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\QuestionAnswers;
use App\Questionnaires;
use Illuminate\Support\Facades\Storage;
use App\QuestionnaireLanguages;
use App\Languages;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questionnaireId = session('questionnaire_id');
        $languageSelectHTML = $this->getQuestionnaireLanguagesHTML($questionnaireId);
        return view('question.create')->with('languageSelectHTML', $languageSelectHTML);
    }

    public function getQuestionnaireLanguagesHTML($id)
    {
        $questionnaireLanguages = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
        $questionLanguageHTML = '<select name="languageid" class="form-control" id="languageid">';
        foreach($questionnaireLanguages as $language)
        {
            $languageArray = $this->languagesToArray($language->languageid);
            $questionLanguageHTML .= '<option value="' . $language->languageid . '">' . $languageArray[$language->languageid] . '</option>';
        }
        $questionLanguageHTML .= '</select>';
        return $questionLanguageHTML;
    }
    
    public function languagesToArray($id)
    {
        $languagesArray = array();
        $languages = Languages::where('id', '=', $id)->get();
        foreach($languages as $language) {
            $languagesArray[$language->id] = $language->language;
        }
        return $languagesArray;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $questionnaireId = $request->session()->get('questionnaire_id');

        $this->validate($request, [
            'questionnumber'  => 'required',
            'languageid'  => 'required',
            'question'    => 'required',
            'questionimage'   => 'required',
            'answertype'  => 'required'
        ]);

        $questions = new Questions;
        $questions->questionnaireid = $questionnaireId;
        $questions->questionnumber = $request->input('questionnumber');
        $questions->languageid = $request->input('languageid');
        $questions->question = $request->input('question');
        $questions->answertype = $request->input('answertype');
        $questions->questionimage = '';
        $questions->save();

        if($request->questionimage) {
            $filename = 'questions/' . $questionnaireId . '/' . $questions->questionid;
            $filename = Storage::disk('public')->put($filename, $request->questionimage);
        }

        $questions->questionimage = $filename;
        $questions->save();

        if($request->input('answertype') == 'select') {
            $this->saveAnswers($request, $questions->questionid, $questionnaireId);
        }

        if($request->finish) {
            return redirect('questionnaires/' . $questionnaireId . '/edit');
        } elseif ($request->submit) {
            return $this->create();
        }
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // set products.name as array
        // session()->put('products.name', []);


        // // somewhere later
        // session()->push('products.name', $name1);

        session()->put('questions', []);
        $questionnaireId = session('questionnaire_id');
        $question = Questions::find($id);
        $answers = QuestionAnswers::where('questionid', '=', $id)->get();

        //if the next question is the last redirect to finish
        $nextislast = false;
        $nextId = $id++;
        $nextQuestion = Questions::find($id);
        if (empty($nextQuestion)) { 
            $nextislast = true;
        } 
        return view('question.show', compact('answers'), compact('nextislast'))->with('question', $question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Questions::find($id);
        $answers = QuestionAnswers::where('questionid', '=', $id)->get();
        return view('question.edit', compact('answers'))->with('question', $question);
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
            'questionnumber'  => 'required',
            'languageid'  => 'required',
            'question'    => 'required',
            'country'   => 'required',
            'answertype'  => 'required'
        ]);

        $question = Questions::find($id);
        $question->questionnumber = $request->input('questionnumber');
        $question->languageid = $request->input('languageid');
        $question->question = $request->input('question');
        $question->questionimage = $request->input('questionimage');
        $question->answertype = $request->input('answertype');
        $question->save();

        // if($request->answer) {
        //     $answers = QuestionAnswers::id(); 
        //     $answers->answer = $request->answer;
        //     $answers->languageid = 7;
        //     $answers->save();
        // }

        return URL::previous();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questions = Questions::find($id);
        $questions->delete();
        $questionnairesEditUrl = url()->previous();
        $questions = Questions::all();
        return redirect(url()->previous())->with('questions', $questions);
    }
}
