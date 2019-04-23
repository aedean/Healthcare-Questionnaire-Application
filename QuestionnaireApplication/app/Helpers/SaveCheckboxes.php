<?php

namespace App\Helpers;

use App\UserAccess;
use App\QuestionnaireTags;
use App\QuestionnaireLanguages;

class SaveCheckboxes
{
    public function storeCheckboxes($request, $objectName, $fieldName, $idName, $relationId, $storeName)
    {
        foreach($request->all() as $field => $data){
            if(strpos($field, $fieldName) !== false){
                if($objectName == 'UserAccess') {
                    $object = new UserAccess;
                } elseif($objectName == 'QuestionnaireLanguages') {
                    $object = new QuestionnaireLanguages;
                } elseif($objectName == 'QuestionnaireTags') {
                    $object = new QuestionnaireTags;
                }
                $object->$idName = $relationId; 
                $object->$storeName = $data; 
                $object->save();
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $fieldName - the name of input field thats being saved to
     * @param  string $objectName - name of the object to be searched against
     * @param  int $id - the id of the element you are checking values for
     * @param  string $storageId - the field that the elements are related to
     * @param  string $searchElement - the element you are checking exists or not
     */
    public function updateCheckboxes($request, $fieldName, $objectName, $id, $storageId, $searchElement)
    {
        if($objectName == 'UserAccess') {
            $existingValuesObject = UserAccess::where('usertypeid', '=', $id)->get();
        } elseif($objectName == 'QuestionnaireLanguages') {
            $existingValuesObject = QuestionnaireLanguages::where('questionnaireid', '=', $id)->get();
        } elseif($objectName == 'QuestionnaireTags') {
            $existingValuesObject = QuestionnaireTags::where('questionnaireid', '=', $id)->get();
        }
        $requestarray = array();
        foreach($request->all() as $field => $data) {
            if(strpos($field, $fieldName) !== false){
                $requestarray[] = array($searchElement => $data);
                if(!in_array($data, array_column($existingValuesObject->all(), $searchElement))) {
                    if($objectName == 'UserAccess') {
                        $object = new UserAccess;
                    } elseif($objectName == 'QuestionnaireLanguages') {
                        $object = new QuestionnaireLanguages;
                    } elseif($objectName == 'QuestionnaireTags') {
                        $object = new QuestionnaireTags;
                    }
                    $object->$storageId = $id;
                    $object->$searchElement = $data;
                    $object->save();
                }
            }
        }
        foreach($existingValuesObject as $object){
            if(!in_array($object->$searchElement, array_column($requestarray, $searchElement))) {
                $object->delete();
            }
        }
    }
}