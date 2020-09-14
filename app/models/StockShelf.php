<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StockShelf extends Model
{
    protected $table = 'stock_shelfs';
    protected $guarded = [''];
    public function stock_items(){
        return $this->belongsTo('App\models\StockItem','stock_item_id','id');
    }
}
