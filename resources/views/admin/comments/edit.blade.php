@extends('admin.layout.master')
@section('title')
    Edit Comment
@endsection
@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-0">Database</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                        <li class="breadcrumb-item active">Comment</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="user_id">User:</label>
                                    <select id="user_id" name="user_id" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $comment->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="post_id">Post:</label>
                                    <select id="post_id" name="post_id" required>
                                        @foreach ($posts as $post)
                                            <option value="{{ $post->id }}"
                                                {{ $comment->post_id == $post->id ? 'selected' : '' }}>
                                                {{ $post->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="mb-3 mt-3">
                    <label for="product_id">Product:</label>
                    <select id="product_id" name="product_id" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $comment->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
                                <div class="mb-3 mt-3">
                                    <label for="content" class="form-label">Content:</label>
                                    <textarea class="form-control" id="content" name="content" required>{{ $comment->content }}</textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-libs')
    {{-- <script src="//cdn.ckeditor.com/4.24.0-lts/basic/ckeditor.js"></script> --}}
    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
@endsection


@section('scripts')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
