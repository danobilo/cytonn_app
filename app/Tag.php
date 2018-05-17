<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function task(){
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    
}
