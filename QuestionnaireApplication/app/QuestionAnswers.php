<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswers extends Model
{
    protected $table = 'question_answers';
    protected $primaryKey = 'answerid';
    protected $foreignKey = 'questionid';
    public $timestamps = true;
    
}
