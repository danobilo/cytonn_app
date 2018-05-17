<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function tasks() {
        return $this->hasMany('App\Task');
    }
    
    public function department() {
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }
}
