<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_profiles(){
        return $this->hasMany('App\models\UserProfile','user_id');
    }
    public function orders(){
        return $this->hasMany('App\models\Order','user_id');
    }
    public function role_users(){
        return $this->belongsTo('App\models\RoleUser','role_user_id');
    }
    public function stock_items(){
        return $this->hasMany('App\models\StockItem','user_id','id');
    }
}
