@extends('layouts.app')

@section('content')

<h4 class="header-title m-b-30">{{ $data['modify'] == 1 ? 'Modify Task' : 'New Task' }}</h4> 

<div class="row">

    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-12">
                    <div class="p-20">
                        <form class="form-horizontal" action="{{ $data['modify'] == 1 ? route('update_task', [ 'task_id' => $data['task_id'] ]) : route('create_task') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Title</label>
                                <div class="col-10">
                                    <input name="title" type="text" class="form-control" value="{{ old('title') ? old('title') : $data['title'] }}">
                                    <small class="error">{{$errors->first('title')}}</small>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Description</label>
                                <div class="col-10">
                                    <input name="description" type="text" class="form-control" value="{{ old('description') ? old('description') : $data['description'] }}">
                                    <!--<textarea class="form-control" rows="3"></textarea>-->
                                    <small class="error">{{$errors->first('description')}}</small>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Category</label>
                                <div class="col-10">
                                    <select name="category_id" class="form-control">
                                        @foreach ($data['categories'] as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <small class="error">{{$errors->first('category_id')}}</small>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-2 col-form-label">Start Date</label>
                                <div class="col-10">
                                    <input class="form-control" type="date" name="start_date" value="{{ old('start_date') ? old('start_date') : $data['start_date'] }}">
                                    <small class="error">{{$errors->first('start_date')}}</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Due Date</label>
                                <div class="col-10">
                                    <input class="form-control" type="date" name="due_date" value="{{ old('due_date') ? old('due_date') : $data['due_date'] }}">
                                    <small class="error">{{$errors->first('due_date')}}</small>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-2 col-form-label">Priority</label>
                                <div class="col-10">
                                    <select name="priority" class="form-control">
                                        @foreach ($data['priorities'] as $priority)
                                        <option value="{{$priority}}">{{$priority}}</option>
                                        @endforeach
                                    </select>
                                    <small class="error">{{$errors->first('priority')}}</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Access Level</label>
                                <div class="col-10">
                                    <select name="private" class="form-control">
                                        <option value="0" >Public</option>
                                        <option value="1" >Private</option>
                                    </select>
                                    <small class="error">{{$errors->first('private')}}</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Assigned To</label>
                                <div class="col-10">
                                    <select name="assigned_to" class="form-control">
                                        @foreach ($data['employees'] as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                        @endforeach

                                    </select>
                                    <small class="error">{{$errors->first('assigned_to')}}</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Progress</label>
                                <div class="col-10">
                                    <select name="progress" class="form-control">
                                        <option value="0" >0%</option>
                                        <option value="10" >10%</option>
                                        <option value="20" >20%</option>
                                        <option value="30" >30%</option>
                                        <option value="40" >40%</option>
                                        <option value="50" >50%</option>
                                        <option value="60" >60%</option>
                                        <option value="70" >70%</option>
                                        <option value="80" >80%</option>
                                        <option value="90" >90%</option>
                                        <option value="100" >100%</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-2 col-form-label">User Groups</label>
                                <div class="col-10">
                                    <select multiple="multiple" class="multi-select" id="my_multi_select2" name="user_group[]" data-plugin="multiselect" data-selectable-optgroup="true"  >

                                        @foreach ($data['departments'] as $department)
                                        <optgroup label="{{$department['name']}}">
                                            @foreach ($department['children'] as $child)
                                            
                                            <option value="{{$child['id']}}">{{$child['name']}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!--                            <div class="form-group row">
                                                            <label class="col-2 col-form-label">Documents</label>
                                                            <div class="col-10">
                                                                <input name="documents" type="file" class="form-control" multiple>
                                                            </div>
                                                        </div>-->

                            <div class="form-group  row">
                                <div class="col-sm-12">
                                    <div class="text-center m-t-30">
                                        <button type="submit" class="btn btn-success waves-effect waves-light">
                                            Save
                                        </button>
                                        <button type="button"
                                                class="btn btn-light waves-effect">Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            <!-- end row -->

        </div> <!-- end card-box -->
    </div><!-- end col -->
</div>
<!-- end row -->
@endsection