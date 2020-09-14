<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = [''];
    public function stock_items(){
        return $this->hasMany('App\models\StockItem','supplier_id','id');
    }
}
