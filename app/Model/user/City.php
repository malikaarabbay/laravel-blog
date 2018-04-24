<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function region(){
        return $this->belongsTo('App\Model\user\Region');
    }
}
