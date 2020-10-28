<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable {

    use Notifiable;

    protected $fillable = [

        'name', 'password','remember_token'
    ];
    protected $hidden = [

        'password','remember_token'
    ];

}
