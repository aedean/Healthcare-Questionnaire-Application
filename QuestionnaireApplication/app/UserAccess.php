<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    protected $table = 'user_accesses';
    protected $primaryKey = 'id';
    protected $foreignKey = 'usertypeid';
    public $timestamps = true;
}
