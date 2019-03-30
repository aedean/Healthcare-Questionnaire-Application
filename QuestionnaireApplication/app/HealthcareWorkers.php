<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthcareWorkers extends Model
{
    protected $table = 'healthcare_workers';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
