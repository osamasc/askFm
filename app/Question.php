<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Like;

class Question extends Model
{
    public function answer()
    {
        return $this->hasOne('App\Answer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes ()
    {
        return $this->hasMany('App\Like');
    }
}
