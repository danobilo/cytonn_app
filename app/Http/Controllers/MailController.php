<?php
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\TaskMail;
use Illuminate\Support\Facades\Mail;
 
class MailController extends Controller
{
    public function send()
    {
        $objTask = new \stdClass();
        $objTask->task_one = 'Task One Value';
        $objTask->task_two = 'Task Two Value';
        $objTask->sender = 'SenderUserName';
        $objTask->receiver = 'ReceiverUserName';
 
        
        Mail::to("receiver@example.com")->send(new TaskMail($objTask));
    }
}