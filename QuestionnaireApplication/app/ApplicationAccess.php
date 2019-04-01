<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationAccess extends Model
{
    protected $table = 'application_accesses';
    protected $primaryKey = 'id';
    protected $foreignKey = 'pageurl';
    public $timestamps = true;
}
