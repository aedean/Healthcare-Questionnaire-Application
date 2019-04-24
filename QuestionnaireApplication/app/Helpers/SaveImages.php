<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class SaveImages
{
    /**
     * Save Image.
     *
     * @param  string $request - request from form
     * @param  string $imagename - name of field of image
     * @param  string $object - object of where the image name will be saved against
     * @param  int $questionnaireId - id of questionnaire
     * @param  int $questionId - id of question
     * @param  int $answerId - id of answer
     */
    public function saveImage($request, $imagename, $object, $questionnaireid, $questionid = null, $answerid = null)
    {
        if($object->$imagename) {
            if(Storage::disk('public')->has($object->$imagename)) {
                Storage::disk('public')->delete($object->$imagename);
            }
        } 
        $filename = '';
        if(is_null($questionid) && is_null($answerid)) {
            $filename = 'questionnaires/' . $questionnaireid;
        } elseif(is_null($answerid)){
            $filename = 'questions/' . $questionnaireid . '/' . $questionid;
        } else {
            $filename = 'answers/' . $questionnaireid . '/' . $questionid . '/' . $answerid;
        }
        $filename = Storage::disk('public')->put($filename, $request->$imagename);
        $object->$imagename = $filename;
        $object->save();
    }
}