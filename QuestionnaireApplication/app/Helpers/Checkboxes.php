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
    /**
     * Get Languages form Html.
     *
     * @param  int $id - id of questionnaire to search questionnaire languages for
     */
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

    /**
     * Get Tags form Html.
     *
     * @param  int $id - id of questionnaire to search questionnaire tags for
     */
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

    /**
     * Get Application Access form Html.
     *
     * @param  int $id - id of questionnaire to search user access for
     */
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

    /**
     * Create checkbox Html.
     *
     * @param  object $checkboxObject - object to loop over for checkbox values
     * @param  string $checkboxId - field name of id value for checkbox
     * @param  string $checkboxName - field name of checkbox display name
     * @param  string $fieldname - name of field
     * @param  string $matchesArray - previously saved items to match against
     * @param  string $checkItem - field to match against in object
     */
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