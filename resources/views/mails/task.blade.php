Hello <i>{{ $task->receiver }}</i>,
<p>This is a task email for testing purposes! Also, it's the HTML version.</p>
 
<p><u>Demo object values:</u></p>
 
<div>
<p><b>Demo One:</b>&nbsp;{{ $task->task_one }}</p>
<p><b>Demo Two:</b>&nbsp;{{ $task->task_two }}</p>
</div>
 
<p><u>Values passed by With method:</u></p>
 
<div>
<p><b>testVarOne:</b>&nbsp;{{ $testVarOne }}</p>
<p><b>testVarTwo:</b>&nbsp;{{ $testVarTwo }}</p>
</div>
 
Thank You,
<br/>
<i>{{ $task->sender }}</i>
