<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireLanguages extends Model
{
    protected $table = 'questionnaire_languages';
    protected $primaryKey = 'id';
    protected $foreignKey = 'questionnaireid';
    public $timestamps = true;
}
