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
                    <label for="created_by" class="form-label">Created By:</label>
                    <input type="number" class="form-control" id="created_by" name="created_by" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
