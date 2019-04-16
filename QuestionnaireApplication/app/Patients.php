<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patients extends Authenticatable
{
    use Notifiable;

    protected $table = 'patients';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guard = 'patients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usertypeid', 'username', 'title', 'firstname', 'lastname', 'dob', 'gender', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
