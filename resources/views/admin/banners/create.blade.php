@extends('admin.layout.master')
@section('title')
    Create New Banner
@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/cropper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/lfm.css') }}">
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-0">Quản lý</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý</a></li>
                        <li class="breadcrumb-item active">Banner</li>
                        <li class="breadcrumb-item active">Thêm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5 class="card-title mb-0">Create New Banner</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name"
                                        name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <input type="text" name="url" class="form-control" id="url"
                                        value="{{ old('url') }}" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="image" class="form-label">Image:</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="image" required>
                                    </div>
                                    <img id="holder" style="margin-top:15px;max-height:100px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="1" checked
                                            name="is_active">Active
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
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
