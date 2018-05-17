<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    public function is_private() {
        return $this->private ? 'Public' : 'Private';
    }

    public function is_open() {
        return $this->open ? 'Open' : 'Closed';
    }

    public function assignee() {
        return $this->belongsTo('App\User', 'assigned_to', 'id');
    }

    public function creator() {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function tags() {
        return $this->hasMany('App\Tag');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
    
    public function documents() {
        return $this->hasMany('App\Document');
    }

}
