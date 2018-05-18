@extends('layouts.app')

@section('content')
<h4 class="header-title m-b-30">Upload Documents</h4> 

<div class="row">
    <div class="col-md-8">
        <div class="card-box task-detail">
            <div class="medium-6 large-5 columns">
                <form method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="file" name="image_upload" />
                    <small class="error">{{$errors->first('image_upload')}}</small>
                    <input type="submit" value="UPLOAD" class="button success hollow" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection