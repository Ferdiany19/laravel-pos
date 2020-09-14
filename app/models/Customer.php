<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [''];
    public function orders(){
        return $this->hasMany('App\models\Order','customer_id');
    }
}
