<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categorys';
    protected $guarded = [''];
    public function items(){
        return $this->hasMany('App\models\items','category_id');
    }
}
