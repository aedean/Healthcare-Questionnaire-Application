<?php

namespace App\Helpers;
use App\UserTypes;

class Selects
{
    /**
     * Get user types Html.
     *
     * @param  string $checkitem - field to check against
     * @param  string $match - current selected value stored
     */
    public function getUserTypes($checkitem = null, $match = null)
    {
        $usertypes = $this->createSelect(UserTypes::all(), 'usertypeid', 'Select a user type', 'usertypeid', 'usertypename', $checkitem, $match);
        return $usertypes;
    }

    /**
     * Get titles Html.
     *
     * @param  string $checkitem - field to check against
     * @param  string $match - current selected value stored
     */
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

    /**
     * Get genders Html.
     *
     * @param  string $checkitem - field to check against
     * @param  string $match - current selected value stored
     */
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

    /**
     * Create select Html.
     *
     * @param  object $selectObject - object to loop over for select values
     * @param  string $fieldName - name of field to be stored later
     * @param  string $fieldTitle - title of input
     * @param  string $selectid - id of select value
     * @param  string $selectname - name of select value
     * @param  string $checkitem - field to check against
     * @param  string $match - current selected value stored
     */
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