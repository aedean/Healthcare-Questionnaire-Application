<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireResultAnswers extends Model
{
    protected $table = 'questionnaire_result_answers';
    protected $primaryKey = 'id';
    protected $foreignKey = 'resultid';
    public $timestamps = true;
}
