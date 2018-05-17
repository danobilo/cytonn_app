<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function employees() {
        return $this->hasMany('App\User');
    }
    public function categories() {
        return $this->hasMany('App\Category');
    }
}
