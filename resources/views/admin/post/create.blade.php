@extends('admin.layout.master')
@section('title')
    Create New Post
@endsection
@section('content')
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" placeholder="Enter description" name="description"></textarea>
                </div>
                <div class="mb-3 mt-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3 mt-3">
                    <label for="status" class="form-label">Status:</label>
                    <select class="form-control" id="" name="status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="content" class="form-label">Content:</label>
                    <textarea class="form-control" id="content" name="content"></textarea>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 mt-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="1" checked name="is_active">Is Active
                        </label>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="created_by" class="form-label">Created By:</label>
                    <input type="number" class="form-control" id="created_by" name="created_by" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('script-libs')
{{-- <script src="//cdn.ckeditor.com/4.24.0-lts/basic/ckeditor.js"></script> --}}
<script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
@endsection


@section('scripts')
    <script>
        CKEDITOR.replace( 'content');
    </script>
@endsection

