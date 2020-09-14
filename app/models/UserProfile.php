<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';
    protected $guarded = [''];
    protected $primaryKey = 'user_id';
    public function users(){
        return $this->belongsTo('App\User','user_id');
    }
}
