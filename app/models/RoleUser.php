<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_users';
    protected $guarded = [''];
    public function users(){
        return $this->hasMany('App\User','role_user_id');
    }
}
