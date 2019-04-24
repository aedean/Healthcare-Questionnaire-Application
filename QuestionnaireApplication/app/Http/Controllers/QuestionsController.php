<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\QuestionAnswers;
use App\Questionnaires;
use Illuminate\Support\Facades\Storage;
use App\QuestionnaireLanguages;
use App\Languages;
use App\Helpers\SaveImages;

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
        $questionnaireId = session()->get('questionnaire')->id;
        $languages = $this->getQuestionnaireLanguagesSelect($questionnaireId);
        return view('question.create')
            ->with('languages', $languages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $questionnaireId = $request->session()->get('questionnaire')->id;

        $this->validate($request, [
            'questionnumber'  => 'required',
            'languageid'  => 'required',
            'question'    => 'required',
            'questionimage'   => 'required',
            'answertype'  => 'required'
        ]);

        $question = new Questions;
        $question->questionnaireid = $questionnaireId;
        $question->questionnumber = $request->input('questionnumber');
        $question->languageid = $request->input('languageid');
        $question->question = $request->input('question');
        $question->answertype = $request->input('answertype');
        $question->questionimage = '';
        $question->save();

        $saveImages = new SaveImages;
        $saveImages->saveImage($request, 'questionimage', $question, $questionnaireId, $question->questionid);

        if($request->input('answertype') == 'select') {
            $this->saveAnswers($request, $questions->questionid, $questionnaireId);
        }

        if($request->finish) {
            return redirect('questionnaires/' . $questionnaireId . '/edit');
        } elseif ($request->submit) {
            return $this->create();
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
        $question = Questions::find($id);
        $answers = QuestionAnswers::where('questionid', '=', $id)->get();
        session()->put('question', $question);
        $questionnaireId = session()->get('questionnaire')->id;
        $languages = $this->getQuestionnaireLanguagesSelect($questionnaireId, $question->questionid);
        return view('question.edit')
            ->with('question', $question)
            ->with('questionnaireId', $questionnaireId)
            ->with('answers', $answers)
            ->with('languages', $languages);
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
        $questionnaireId = $request->session()->get('questionnaire')->id; 

        $this->validate($request, [
            'questionnumber'  => 'required',
            'languageid'  => 'required',
            'question'    => 'required',
            'answertype'  => 'required'
        ]);

        $question = Questions::find($id);
        $question->questionnumber = $request->input('questionnumber');
        $question->languageid = $request->input('languageid');
        $question->question = $request->input('question');
        $question->answertype = $request->input('answertype');
        $question->save();

        if($request->questionimage) {
            $saveImages = new SaveImages;
            $saveImages->saveImage($request, 'questionimage', $question, $questionnaireId, $question->questionid);
        }
        
        return redirect('question/' . $id. '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Questions::find($id);
        $question->delete();
        $questionanswers = QuestionAnswers::where('questionid', '=', $id)->get();
        foreach($questionanswers as $answer) {
            $answer->delete();
        }
        return redirect(url()->previous());
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

    public function getQuestionnaireLanguagesSelect($id, $questionlanguageid = null)
    {
        $questionnaireLanguages = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
        $questionLanguageHTML = '<select name="languageid" class="form-control" id="languageid">';
        foreach($questionnaireLanguages as $language)
        {
            $languageArray = $this->languagesToArray($language->languageid);
            $selected = '';
            if($language->languageid == $questionlanguageid) {
                $selected = 'selected';
            }
            $questionLanguageHTML .= '<option value="' . $language->languageid . '" ' . $selected . '>' . $languageArray[$language->languageid] . '</option>';
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
}
