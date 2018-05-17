<?php

namespace App\Http\Controllers;

use App\Task as Task;
use App\User as User;
use App\Tag as Tag;

use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function addTag($task_id, $user_id) {
        $tag = new Tag();
        $task_instance = new Task();
        $user_instance = new User();

        $task = $task_instance->find($task_id);
        $user = $user_instance->find($user_id);

        $tag->user()->associate($user);
        $tag->task()->associate($task);

        $tag->save();

        return redirect()->route('tasks');
        //return view('reservations/bookRoom');
    }
}
