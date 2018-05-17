Hello {{ $task->receiver }},
This is a task email for testing purposes! Also, it's the HTML version.
 
Demo object values:
 
Demo One: {{ $task->task_one }}
Demo Two: {{ $task->task_two }}
 
Values passed by With method:
 
testVarOne: {{ $testVarOne }}
testVarOne: {{ $testVarOne }}
 
Thank You,
{{ $task->sender }}