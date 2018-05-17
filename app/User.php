<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
//    public function tasks()
//    {
//        return $this->hasMany('App\Task');
//    }
    
    public function tasks(){
        return $this->belongsTo('App\Task', 'assigned_to', 'id');
    }
    
    public function department(){
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
