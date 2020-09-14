<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StockRetur extends Model
{
    protected $table = 'stock_returs';
    protected $dates = ['expire'];
    protected $guarded = [''];
}
