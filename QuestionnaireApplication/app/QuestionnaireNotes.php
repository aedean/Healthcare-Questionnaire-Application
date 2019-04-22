<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireNotes extends Model
{
    protected $table = 'questionnaire_notes';
    protected $primaryKey = 'id';
    protected $foreignKey = 'questionnaireid';
    public $timestamps = true;
}
