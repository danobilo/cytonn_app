Hello <i>{{ $user->name }}</i>,
<p>This is a task email for testing purposes! Also, it's the HTML version.</p>
 
<p><u>Task Details:</u></p>
 
<div>
<p><b>Task name:</b>&nbsp;{{ $task->title }}</p>
<p><b>Due Date:</b>&nbsp;{{ $task->due_date }}</p>
</div>

Thank You,
<br/>
<i>{{ $task->creator->name }}</i>
