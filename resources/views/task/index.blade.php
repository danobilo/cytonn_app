@extends('layouts.app')

@section('content')
<h4 class="header-title m-b-30">All Tasks</h4>

<div class="row">
    <div class="col-sm-3">
        <a href="{{ route('new_task') }}" class="btn btn-purple btn-rounded w-sm waves-effect waves-light m-b-10">Create Task</a>
        <a href="{{ route('new_category') }}" class="btn btn-purple btn-rounded w-sm waves-effect waves-light m-b-20">Create Category</a>
        <a href="{{ route('export') }}" class="btn btn-success btn-rounded w-sm waves-effect waves-light m-b-20">export</a>
    </div>
    <div class="col-sm-9">
        <div class="project-sort pull-right">
            <div class="project-sort-item">
                <form class="form-inline"  action="{{ route('filter_tasks') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Select Department :</label>
                        <select class="form-control ml-2 form-control-sm"  name="department">
                            <option>All Departments</option>
                            @foreach( $departments as $department )
                            <option value="{{ $department->id }}" >{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Task :</label>
                        <select class="form-control ml-2 form-control-sm"  name="tasks">
                            <option value="user" >All My Tasks</option>
                            <option value="overdue" >My Overdue Tasks</option>
                            <option value="open" >My Open Tasks</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Access :</label>
                        <select class="form-control ml-2 form-control-sm"  name="access">
                            <option value="All">All</option>
                            <option value="0">Public</option>
                            <option value="1">Private</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success btn-rounded w-sm waves-effect waves-light m-b-20">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- end col-->
</div>
<!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
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
                        <th>Comments</th>
                        <th>View</th>
                        <th>Document</th>
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
                        <td>{{ $task->comments->count() }}</td>
                        <td> <a class="hollow button" href="{{ route('show_task_details', ['task_id' => $task->id ]) }}">View</a></td>
                        <td> <a class="hollow button" href="{{ route('upload', ['task_id' => $task->id ]) }}">Add</a></td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div> <!-- end row -->
@endsection