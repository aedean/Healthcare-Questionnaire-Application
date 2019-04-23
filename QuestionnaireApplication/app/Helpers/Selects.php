<?php

namespace App\Helpers;
use App\UserTypes;

class Selects
{
    public function getUserTypes($checkitem = null, $match = null)
    {
        $usertypes = $this->createSelect(UserTypes::all(), 'usertypeid', 'Select a user type', 'usertypeid', 'usertypename', $checkitem, $match);
        return $usertypes;
    }

    public function getTitles($checkitem = null, $match = null) 
    {
        $titles = (object) array(
            1 => (object) array(
                'titlename' => 'Miss'
            ),
            2 => (object) array(
                'titlename' => 'Mr'
            ),
            3 => (object) array(
                'titlename' => 'Mrs'
            ),
            4 => (object) array(
                'titlename' => 'Ms'
            ),
            5 => (object) array(
                'titlename' => 'Other'
            )
        );
        $titles = $this->createSelect($titles, 'title', 'Select a title', 'titlename', 'titlename', $checkitem, $match);
        return $titles;
    }

    public function getGenders($checkitem = null, $match = null) 
    {
        $genders = (object) array(
            1 => (object) array(
                'gender' => 'Male'
            ),
            2 => (object) array(
                'gender' => 'Female'
            ),
            3 => (object) array(
                'gender' => 'Other'
            )
        );
        $genders = $this->createSelect($genders, 'gender', 'Select a gender', 'gender', 'gender', $checkitem, $match);
        return $genders;
    }

    public function createSelect($selectObject, $fieldname, $fieldTitle, $selectid, $selectname, $checkitem = null, $match = null) {
        $createHTML = '<select name="' . $fieldname . '" class="form-control" id="' . $fieldname . '">';
        $createHTML .= '<option value="">' . $fieldTitle . '</option>';
        foreach($selectObject as $select) {
            $selected = '';
            if($match != null && $match == $select->$checkitem) {
                $selected = 'selected="selected"';
            }
            $createHTML .= '<option ' . $selected . ' value="' . $select->$selectid . '">' . $select->$selectname . '</option>';
        }
        $createHTML .= '</select>';
        return $createHTML;
    }

}