<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireBoundaries extends Model
{
    protected $table = 'questionnaire_boundaries';
    protected $primaryKey = 'id';
    protected $foreignKey = 'questionnaireid';
    public $timestamps = true;
}

