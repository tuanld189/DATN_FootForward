@extends('admin.layout.master')
@section('title')
    Update Category: {{$model->name}}
@endsection
@section('style-libs')
<link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/cropper.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/lfm.css') }}">
@endsection
@section('content')
<div class="a" style="background-color:white; padding:30px;">
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;">
    <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')
</h3>
<form action="{{route('admin.categories.update', $model->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name"
                value="{{$model->name}}"
                placeholder="Enter name" name="name">
            </div>
            <div class="mb-3 mt-3">
                <label for="image" class="form-label">Image:</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="image" value="{{$model->image}}" required>
                </div>
                <img id="holder" style="margin-top:15px;max-height:100px;" src="{{$model->image }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3 mt-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="1"
                    @if ($model->is_active)
                        checked
                    @endif
                    checked name="is_active">Active
                </label>
            </div>
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
@endsection
@section('scripts')
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/cropper.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#lfm').filemanager('image');
    });
</script>
@endsection
