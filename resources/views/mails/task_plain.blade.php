Hello {{ $user->name }},
This is a task email for testing purposes! Also, it's the HTML version.
 
Demo object values:
 
Demo One: {{ $task->title }}
Demo Two: {{ $task->due_date }}
 
 
Thank You,
{{ $task->creator->name }}