@extends('admin.layout.master')
@section('title')
    Edit Post
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                        <li class="breadcrumb-item active">Posts</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xxl-12 ">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.posts.update', $model->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name"
                                        name="name" value="{{ $model->name }}" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea class="form-control" id="description" placeholder="Enter description" name="description">{{ $model->description }}</textarea>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="image" class="form-label">Image:</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @if ($model->image)
                                        <img src="{{ asset('storage/' . $model->image) }}" alt="Current Image"
                                            style="max-height: 100px;">
                                    @endif
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="description" class="form-label">Content:</label>
                                    {{-- <textarea class="form-control" id="content" placeholder="Enter content" name="content">{{ $model->content }}</textarea> --}}
                                    <textarea class="form-control" id="ckeditor-classic" placeholder="Enter content" name="content">{{ $model->content }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 mt-3">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                @if ($model->is_active) checked @endif checked name="is_active">Is
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection --}}

@section('scripts')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
@section('script-libs')
    <!-- ckeditor -->
    <script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <!-- dropzone js -->
    <script src="assets/libs/dropzone/dropzone-min.js"></script>
    <!-- project-create init -->
    <script src="assets/js/pages/project-create.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
@endsection
