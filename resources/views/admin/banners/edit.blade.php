@extends('admin.layout.master')

@section('title')
    Update Banner: {{ $model->name }}
@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/cropper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/lfm.css') }}">
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-0">Chỉnh sửa Banner</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Trang quản trị</a></li>
                    <li class="breadcrumb-item active">Quản lí Banner</li>
                    <li class="breadcrumb-item active">Chỉnh sửa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="a" style="background-color:white; padding:30px;">
    <h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;">
        <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image">
        @yield('title')
    </h3>

    <form action="{{ route('admin.banners.update', $model->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" value="{{ $model->name }}"
                        placeholder="Enter name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="url">URL:</label>
                    <input type="text" name="url" class="form-control" id="url" value="{{ old('url', $model->url) }}" required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="image" class="form-label">Image:</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="thumbnail" class="form-control" type="text" name="image" value="{{ $model->image }}">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <img id="holder" src="{{ $model->image }}" style="margin-top:15px;max-height:100px;">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1"
                            @if ($model->is_active) checked @endif name="is_active"> Active
                    </label>
                </div>
            </div>
        </div>

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
