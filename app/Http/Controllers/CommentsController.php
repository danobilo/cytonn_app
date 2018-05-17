<?php

namespace App\Http\Controllers;

use App\Task as Task;
use App\User as User;
use App\Comment as Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller {

    //
    public function addComment(Request $request, $task_id, $user_id) {
        $comment = new Comment();
        $task_instance = new Task();
        $user_instance = new User();

        $task = $task_instance->find($task_id);
        $user = $user_instance->find($user_id);
        $comment->comment = $task->title = $request->input('comment');

        $comment->user()->associate($user);
        $comment->task()->associate($task);

        $comment->save();

        return redirect()->route('show_task_details', ['task_id' => $task_id ]) ;
        //return view('reservations/bookRoom');
    }
    
    

}
