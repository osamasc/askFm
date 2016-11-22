<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function Question()
    {
        return $this->belongsTo('App\Question');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
