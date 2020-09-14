<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $table = 'stock_items';
    protected $guarded = [''];
    protected $dates = ['expire'];
    public function items(){
        return $this->belongsTo('App\models\Item','item_id','id');
    }
    public function suppliers(){
        return $this->belongsTo('App\models\Supplier','supplier_id','id');
    }
    public function stock_shelfs(){
        return $this->hasMany('App\models\StockShelf','stock_item_id','id');
    }
    public function users(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
