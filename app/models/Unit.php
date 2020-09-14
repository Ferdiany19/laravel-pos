<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = [''];
    public function items(){
        return $this->hasMany('App\models\Item','unit_id');
    }
}
