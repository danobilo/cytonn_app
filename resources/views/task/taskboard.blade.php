@extends('layouts.app')

@section('content')
<h4 class="header-title m-b-30">User Board</h4>

<div class="col-12">
    <div class="card-box">
        <div class="row">

            <div class="col-sm-8">
                <div class="project-sort pull-right">
                    <div class="project-sort-item">
                        <form class="form-inline"  action="{{ route('show_user_board') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('user') ? ' has-error' : '' }}"">
                                <label>Select User :</label>
                                <select class="form-control ml-2 form-control-sm" id="user" name="user">
                                    <option value="0">All Users</option>
                                    @foreach( $employees as $employee )
                                    <option value="{{ $employee->id }}" {{ $selected_user == $employee->id ? 'selected' : ''}} >{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">

                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    Search
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- end col-->
        </div>
        <!-- end row -->
    </div>
</div>


<div class="row">
    <div class="col-xl-4">
        <div class="card-box taskboard-box">

            <h4 class="header-title m-t-0 m-b-30 text-primary">Upcoming</h4>

            <ul class="list-unstyled task-list" id="drag-upcoming">
                @foreach( $upcoming as $upcoming_task )
                <li>
                    <div class="card-box kanban-box">

                        <div class="kanban-detail">
                            <span class="badge badge-warning pull-right">{{ $upcoming_task->priority }}</span>
                            <h4><a href="#">{{ $upcoming_task->title }}</a> </h4>
                            <ul class="list-inline m-b-0">
                                <li class="list-inline-item">
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="" data-original-title="Username">
                                        <img src="assets/images/users/avatar-3.jpg" alt="img"
                                             class="thumb-sm rounded-circle">
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    {{ $upcoming_task->assignee->name }}
                                </li>
                                <li class="list-inline-item">
                                    {{ $upcoming_task->due_date }}
                                </li>
                                <li class="list-inline-item">
                                    {{ $upcoming_task->progress }}%
                                </li>

                                <li class="list-inline-item">
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="" data-original-title="{{ $upcoming_task->comments->count() }}">
                                        <i class="mdi mdi-comment-outline"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @endforeach


            </ul>

        </div>
    </div><!-- end col -->


    <div class="col-xl-4">
        <div class="card-box taskboard-box">

            <h4 class="header-title m-t-0 m-b-30 text-warning">In Progress</h4>

            <ul class="list-unstyled task-list" id="drag-inprogress">
                @foreach( $ongoing as $ongoing_task )
                <li>
                    <div class="card-box kanban-box">
                        <div class="checkbox-wrapper">
                            <div class="checkbox checkbox-success checkbox-single">
                                <input type="checkbox" id="singleCheckbox2" value="option2"
                                       aria-label="Single checkbox Two">
                                <label></label>
                            </div>
                        </div>

                        <div class="kanban-detail">
                            <span class="badge badge-primary pull-right">{{ $ongoing_task->priority }}</span>
                            <h4><a href="#">{{ $ongoing_task->title }}</a> </h4>
                            <ul class="list-inline m-b-0">
                                <li class="list-inline-item">
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="" data-original-title="Username">
                                        <img src="assets/images/users/avatar-3.jpg" alt="img"
                                             class="thumb-sm rounded-circle">
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    {{ $ongoing_task->assignee->name }}
                                </li>
                                <li class="list-inline-item">
                                    {{ $ongoing_task->due_date }}
                                </li>
                                <li class="list-inline-item">
                                    {{ $ongoing_task->progress }}%
                                </li>

                                <li class="list-inline-item">
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="" data-original-title="{{ $ongoing_task->comments->count() }}">
                                        <i class="mdi mdi-comment-outline"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>

        </div>
    </div><!-- end col -->


    <div class="col-xl-4">
        <div class="card-box taskboard-box">


            <h4 class="header-title m-t-0 m-b-30 text-success">Complete</h4>

            <ul class="list-unstyled task-list" id="drag-complete">
                @foreach( $completed as $completed_task )
                <li>
                    <div class="card-box kanban-box">
                        <div class="checkbox-wrapper">
                            <div class="checkbox checkbox-success checkbox-single">
                                <input type="checkbox" id="singleCheckbox2" value="option2"
                                       aria-label="Single checkbox Two">
                                <label></label>
                            </div>
                        </div>

                        <div class="kanban-detail">
                            <span class="badge badge-success pull-right">{{ $completed_task->priority }}</span>
                            <h4><a href="#">{{ $completed_task->title }}</a> </h4>
                            <ul class="list-inline m-b-0">
                                <li class="list-inline-item">
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="" data-original-title="Username">
                                        <img src="assets/images/users/avatar-3.jpg" alt="img"
                                             class="thumb-sm rounded-circle">
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    {{ $completed_task->assignee->name }}
                                </li>
                                <li class="list-inline-item">
                                    {{ $completed_task->due_date }}
                                </li>
                                <li class="list-inline-item">
                                    {{ $completed_task->progress }}%
                                </li>

                                <li class="list-inline-item">
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="" data-original-title="{{ $completed_task->comments->count() }}">
                                        <i class="mdi mdi-comment-outline"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>

        </div>
    </div><!-- end col -->


</div>
<!-- end row -->
@endsection