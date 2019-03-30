<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    protected $table = 'system_configs';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
