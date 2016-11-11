<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    public function followed()
    {
        return $this->belongsTo('App\User', 'followed_id');
    }
}
