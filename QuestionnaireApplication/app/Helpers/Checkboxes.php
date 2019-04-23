<?php

namespace App\Helpers;

use App\ApplicationAccess;
use App\UserAccess;
use App\Languages;
use App\QuestionnaireLanguages;
use App\QuestionnaireTags;
use App\Tags;

class Checkboxes
{
    public function getLanguages($id = null)
    {
        if(!is_null($id)) {
            $questionnairelanguages = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
            $questionnairelanguagesarray = array();
            foreach($questionnairelanguages as $language) {
                $questionnairelanguagesarray[] = $language->languageid;
            }
            $languages = $this->createCheckboxes(Languages::all(), 'id', 'language', 'language', $questionnairelanguagesarray, 'id');
            return $languages;
        } else {
            $languages = $this->createCheckboxes(Languages::all(), 'id', 'language', 'language');
            return $languages;
        }
    }

    public function getTags($id = null)
    {
        if(!is_null($id)) {
            $questionnairetags = QuestionnaireTags::where('questionnaireid', '=', $id)->get();
            $questionnairetagsarray = array();
            foreach($questionnairetags as $tag) {
                $questionnairetagsarray[] = $tag->tagid;
            }
            $tags = $this->createCheckboxes(Tags::all(), 'id', 'tagname', 'tag', $questionnairetagsarray, 'id');
            return $tags;
        } else {
            $tags = $this->createCheckboxes(Tags::all(), 'id', 'tagname', 'tag');
            return $tags;
        }
    }

    public function getApplicationAccess($id = null)
    {
        if(!is_null($id)) {
            $useraccess = UserAccess::where('usertypeid', '=', $id)->get();
            $useraccessarray = array();
            foreach($useraccess as $access) {
                $useraccessarray[] = $access->pageurlid;
            }
            $applicationAccess = $this->createCheckboxes(ApplicationAccess::all(), 'id', 'pageurl', 'useraccess', $useraccessarray, 'id');
            return $applicationAccess;
        } else {
            $applicationAccess = $this->createCheckboxes(ApplicationAccess::all(), 'id', 'pageurl', 'useraccess');
            return $applicationAccess;
        }
    }

    public function createCheckboxes($checkboxObject, $checkboxId, $checkboxName, $fieldname, $matchesArray = null, $checkItem = null)
    {
        $createHTML = '';
        foreach($checkboxObject as $checkbox){
            $checked = '';
            if(!is_null($matchesArray) && in_array($checkbox->$checkItem, $matchesArray)) {
                $checked = 'checked';
            }
            $createHTML .= '<input type="checkbox" name="' . $fieldname . $checkbox->$checkboxId . '" value="' . $checkbox->$checkboxId . '" ' . $checked . ' >' . $checkbox->$checkboxName . '<br>';
        }
        return $createHTML;
    }
}