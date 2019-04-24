<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'questionid';
    protected $foreignKey = 'questionnaireid';
    public $timestamps = true;
}
