<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthcareContacts extends Model
{
    protected $table = 'healthcare_contacts';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
