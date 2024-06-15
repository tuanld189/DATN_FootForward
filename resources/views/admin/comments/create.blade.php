@extends('admin.layout.master')
@section('title')
    Create New Comment
@endsection
@section('content')
    <form action="{{ route('admin.comments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="user_id">User:</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="post_id">Post:</label>
                    <select class="form-control" id="post_id" name="post_id" required>
                        @foreach ($posts as $post)
                            <option value="{{ $post->id }}">{{ $post->name }}</option> <!-- Sửa thành title -->
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="content" class="form-label">Content:</label>
                    <textarea class="form-control" id="content" placeholder="Enter content" name="content"></textarea> <!-- Sửa thành description -->
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('description'); <!-- Sửa thành description -->
    </script>
@endsection
