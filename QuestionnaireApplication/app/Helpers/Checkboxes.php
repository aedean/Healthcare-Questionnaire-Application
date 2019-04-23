<?php

namespace App\Helpers;

use App\ApplicationAccess;
use App\UserAccess;

class Checkboxes
{
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