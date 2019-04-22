<?php

namespace App\Helpers;

use App\UserAccess;

class SaveCheckboxes
{
    public function storeCheckboxes($request, $objectName, $fieldName, $idName, $relationId, $storeName)
    {
        foreach($request->all() as $field => $data){
            if(strpos($field, $fieldName) !== false){
                if($objectName == 'UserAccess') {
                    $object = new UserAccess;
                }
                $object->$idName = $relationId;
                $object->$storeName = $data;
                $object->save();
            }
        }
    }

    public function updateCheckboxes($request, $fieldName, $objectName)
    {
        //if contains useraccess check if value exists in useraccess - if not add 
        //
        foreach($request->all() as $field => $data){
            if(strpos($field, $fieldName) !== false){
                if($objectName == 'UserAccess') {
                    $object = new UserAccess;
                    //if(count($object) == 0){
                        //new
                    //}
                }
                $object::where('')->get();
            }
        }


        //foreach useraccess check if in request - if not delete
        // foreach(){

        // }
    }
}