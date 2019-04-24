<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaires extends Model
{
    protected $table = 'questionnaires';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
