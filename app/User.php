<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','gender','username','fullname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function about()
    {
        return $this->hasOne('App\About');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');  
    }

    
}
