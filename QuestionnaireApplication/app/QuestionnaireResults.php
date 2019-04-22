<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireResults extends Model
{
    protected $table = 'questionnaire_results';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
