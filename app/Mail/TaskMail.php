<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 
class TaskMail extends Mailable
{
    use Queueable, SerializesModels;
     
    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $task;
    public $user;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($task,$user)
    {
        $this->task = $task;
        $this->user = $user;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['task'] = $this->task;
        $data['user'] = $this->user;
        return $this->from($this->task->creator->email)
                    ->view('mails.task')
                    ->text('mails.task_plain')
                    ->with($data);
    }
}