<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Task Key</th>
            <th>Task Name</th>
            <th>Task Type</th>
            <th>Prority</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>% Done</th>
            <th>Created by</th>
            <th>Assigned to</th>
        </tr>
    </thead>


    <tbody>
        @foreach( $tasks as $task )
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->is_private() }}</td>
            <td>{{ $task->priority }}</td>
            <td>{{ $task->due_date }}</td>
            <td>{{ $task->is_open() }}</td>
            <td>{{ $task->progress }}%</td>
            <td>{{ $task->creator->name }}</td>
            <td>{{ $task->assignee->name }}</td>
        </tr>
        @endforeach

    </tbody>
</table>

