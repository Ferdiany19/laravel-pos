<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [''];
    public function order_details(){
        return $this->hasMany('App\models\OrderDetail','order_id');
    } 
    public function customers(){
        return $this->belongsTo('App\models\Customer','customer_id');
    } 
    public function users(){
        return $this->belongsTo('App\User','user_id');
    }
}
