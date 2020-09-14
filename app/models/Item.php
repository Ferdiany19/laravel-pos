<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [''];
    public function order_details(){
        return $this->hasMany('App\models\OrderDetail','item_id');
    }
    public function categorys(){
        return $this->belongsTo('App\models\Category','category_id');
    }
    public function units(){
        return $this->belongsTo('App\models\Unit','unit_id');
    }
    public function stock_items(){
        return $this->hasMany('App\models\StockItem','item_id','id');
    }
}
