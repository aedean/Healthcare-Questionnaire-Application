<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_addresses';
    protected $primaryKey = 'addressid';
    protected $foreignKey = 'userid';
    public $timestamps = true;
}
