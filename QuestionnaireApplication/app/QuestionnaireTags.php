<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireTags extends Model
{
    protected $table = 'questionnaire_tags';
    protected $primaryKey = 'id';
    protected $foreignKey = 'questionnaireid';
    public $timestamps = true;
}
