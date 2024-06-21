@extends('admin.layout.master')
@section('title')
    Comments Details
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>Comments Details</h3>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <p><strong>User:</strong></p>
                    <ul>
                        @foreach ($comment->users as $user)
                            <li>{{ $user->name }}</li>
                        @endforeach
                    </ul>
                    <p><strong>Post:</strong></p>
                    <ul>
                        @foreach ($comment->posts as $post)
                            <li>{{ $post->name }}</li>
                        @endforeach
                    </ul>
                    {{-- <p><strong>Product:</strong></p>
                    <ul>
                        @foreach ($comment->products as $product)
                            <li>{{ $product->name }}</li>
                        @endforeach
                    </ul> --}}
                    <div class="col-md-6">
                        <p><strong>Content:</strong> {{ $comment->content }}</p>

                        {{-- <p><strong>Active:</strong> {{ $comment->is_active ? 'Yes' : 'No' }}</p> --}}
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.comments.edit', $user->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('admin.comments.destroy', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
            <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
