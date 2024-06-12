@extends('admin.layout.master')
@section('title')
    Edit Post
@endsection
@section('content')
    <form action="{{ route('admin.posts.update', $model->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ $model->name }}" required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" placeholder="Enter description" name="description">{{ $model->description }}</textarea>
                </div>
                <div class="mb-3 mt-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($model->image)
                        <img src="{{ asset('storage/' . $model->image) }}" alt="Current Image" style="max-height: 100px;">
                    @endif
                </div>
                <div class="mb-3 mt-3">
                    <label for="status" class="form-label">Status:</label>
                    <select class="form-control" id="" name="status" required>
                        <option value="1" {{ $model->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $model->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="description" class="form-label">Content:</label>
                    <textarea class="form-control" id="content" placeholder="Enter content" name="content">{{ $model->content }}</textarea>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 mt-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="1"
                            @if ($model->is_active)
                                checked
                            @endif
                            checked name="is_active">Is Active
                        </label>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="created_by" class="form-label">Created By:</label>
                    <input type="number" class="form-control" id="created_by" name="created_by" value="{{ $model->created_by }}" required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="updated_by" class="form-label">Updated By:</label>
                    <input type="number" class="form-control" id="updated_by" name="updated_by" value="{{ $model->updated_by }}" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
