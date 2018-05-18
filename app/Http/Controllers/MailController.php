<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TaskMail;
use Illuminate\Support\Facades\Mail;
use App\Task as Task;
use App\User as User;

class MailController extends Controller {

    public function __construct(Task $task, User $user) {
        $this->task = $task;
        $this->user = $user;
    }

    public function send($task_id, $user_id) {

        $task_data = $this->task->find($task_id);
        $user_data = $this->user->find($user_id);

        Mail::to($user_data->email)->send(new TaskMail($task_data,$user_data));
    }

}
