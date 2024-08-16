@extends('admin.layout.master')
@section('title')
    Comment Details
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>Chi tiết bình luận</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Người dùng:</strong> {{ $comment->user->name ?? 'N/A' }}</p>

                    <p><strong>Bài viết:</strong> {{ $comment->post->title ?? 'N/A' }}</p>

                    <p><strong>Sản phẩm:</strong> {{ $comment->product->name ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6">
                    <p><strong>Bình luận:</strong> {{ $comment->content }}</p>
                </div>
            </div>
            {{-- <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form> --}}
            <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
