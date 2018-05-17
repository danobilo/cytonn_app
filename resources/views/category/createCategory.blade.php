@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Create Category</h4>

            <div class="row">
                <div class="col-12">
                    <div class="p-20">
                        <form class="form-horizontal" action="{{ route('create_category') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Department</label>
                                <div class="col-10">
                                    <select class="form-control" name="department_id">
                                        @foreach( $departments as $department )
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Category Name</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" value="" name="name" required>
                                    <small class="error">{{$errors->first('name')}}</small>
                                </div>
                            </div>


                            <div class="form-group  row">
                                <div class="col-sm-12">
                                    <div class="text-center m-t-30">
                                        <button type="submit" class="btn btn-success waves-effect waves-light">
                                            Save
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

