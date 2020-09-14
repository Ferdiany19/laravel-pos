<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $guarded = [''];
    public function orders(){
        return $this->belongsTo('App\models\Order','order_id');
    }
    public function items(){
        return $this->belongsTo('App\models\Item','item_id');
    }
}
