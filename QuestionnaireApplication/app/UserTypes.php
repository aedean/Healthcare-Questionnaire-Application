<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    protected $table = 'user_types';
    protected $primaryKey = 'usertypeid';
    public $timestamps = true;
}
