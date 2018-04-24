<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function country(){
        return $this->belongsTo('App\Model\user\Country');
    }
}
