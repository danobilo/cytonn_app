@extends('layouts.app')

@section('content')
<h4 class="header-title m-b-30">Task Details</h4> 

<div class="row">
    <div class="col-md-8">
        <div class="card-box task-detail">
            @if( ($task->created_by === $user->id) || ($task->creator->job_level < $user->job_level) )
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-right m-t-30">
                        <a class="btn btn-primary waves-effect" href="{{ route('show_task', ['task_id' => $task->id ]) }}" role="button">Edit</a>
                    </div>
                </div>
            </div>
            @endif
            <div class="media m-b-30">
                <img class="d-flex mr-3 rounded-circle" alt="64x64" src="{{ asset('assets/images/users/avatar-2.jpg') }}" style="width: 48px; height: 48px;">
                <div class="media-body">
                    <h4 class="media-heading mb-0 mt-0">{{ $task->creator->name }}</h4>
                    <span class="badge badge-{{ $badge }}">{{ $task->priority }}</span>
                </div>
            </div>

            <h4 class="font-600 m-b-20">{{ $task->title }}</h4>

            <p class="text-muted">
                {{ $task->description }}
            </p>

            <ul class="list-inline task-dates m-b-0 m-t-20">
                <li>
                    <h5 class="font-600 m-b-5">Start Date</h5>
                    <p> {{ $task->start_date }} <small class="text-muted"></small></p>
                </li>

                <li>
                    <h5 class="font-600 m-b-5">Due Date</h5>
                    <p> {{ $task->due_date }} <small class="text-muted"></small></p>
                </li>
            </ul>
            <div class="clearfix"></div>

            <div class="task-tags m-t-20">
                <h5 class="font-600">Departments</h5>
                <ul class="list-inline">
                    @foreach($departments as $department)
                    <li>{{ $department->name }}</li>
                    @endforeach 
                </ul>

            </div>

            <div class="task-tags m-t-20">
                <h5 class="font-600">Category</h5>
                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="{{ $task->category->name }}">
<!--                <input type="text" value="{{ $task->category->name }}" data-role="tagsinput"/>-->
            </div>

            <div class="task-tags m-t-20">
                <h5 class="font-600">Users</h5>
                <ul class="list-inline">
                    @foreach ($tags as $tag)
                    <li>{{ $tag->user->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="assign-team m-t-30">
                <h5 class="font-600 m-b-5">Assigned to</h5>
                <div>
                    <img class="rounded-circle thumb-sm" alt="64x64" src="{{ asset('assets/images/users/avatar-2.jpg') }}"> {{ $task->assignee->name }}
                </div>
            </div>
            <h5 class="font-600">Progress</h5>
            <div class="progress progress-md">
                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ $task->progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $task->progress }}%;">
                    {{ $task->progress }}%
                </div>
            </div>

            <div class="attached-files m-t-30">
                <h5 class="font-600">Attached Files </h5>
                <div class="files-list">
                    @foreach ($documents as $document)
                    <div class="file-box">
                        <a href="{{ route('download', ['filename' => $document->name ]) }}"><img class="media-object rounded-circle thumb-sm" alt="64x64" src="{{ asset('assets/images/file.png') }}"></i></a>
                        <p class="font-13 m-b-5">{{ $document->name }}</p>
                    </div>
                    @endforeach

                </div>

            </div>

        </div>
    </div><!-- end col -->

    <div class="col-md-4">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Comments ({{ $comments->count() }})</h4>

            <div>
                @foreach ($comments as $comment)
                <div class="media m-b-20">
                    <div class="d-flex mr-3">
                        <a href="#"> <img class="media-object rounded-circle thumb-sm" alt="64x64" src="{{ asset('assets/images/users/avatar-1.jpg') }}"> </a>
                    </div>
                    <div class="media-body">
                        <h5 class="mt-0">{{ $comment->user->name }}</h5>
                        <p class="font-13 text-muted mb-0">
                            {{ $comment->comment }}
                        </p>
                    </div>
                </div>
                @endforeach


                <div class="media m-b-20">
                    <div class="d-flex mr-3">
                        <a href="#"> <img class="media-object rounded-circle thumb-sm" alt="64x64" src="assets/images/users/avatar-1.jpg"> </a>
                    </div>
                    <form action="{{ route('add_comment', [ 'task_id' => $task->id, 'user_id' => 1 ])  }}" method="post">
                        {{ csrf_field() }}
                        <div class="media-body">
                            <textarea name="comment" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="medium-12  columns">
                            <input value="Add" class="button success hollow" type="submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->
@endsection