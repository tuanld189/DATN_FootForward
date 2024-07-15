@extends('client.layouts.master')

@section('title', 'Chi tiết bài viết')

@section('content')

    {{-- test --}}
    <div class="container m-4 m-auto ">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Post</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Post</li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    {{-- test --}}

    {{-- <div class="latest-blog-slider"> --}}
    <div class="container m-8">
        <div class="single-post">
            <h2>{{ $post->name }}</h2>
            <div class="post-meta">
                <span><i class="fa fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}</span> <br>
                {{-- <span><i class="fa fa-user"></i> {{ $post->author->name ?? 'Unknown' }}</span> --}}
                <span><i class="fa fa-user"></i> {{ Auth::check() ? Auth::user()->name : '' }}</span>

                {{-- <span><i class="fa fa-user"></i>
                    {{ $post->author->name ?? 'Hacker nhưng mà khoog biết hack fb e :))' }}</span> --}}
            </div>

            <div class="post-content">
                 <p> Mô tả:{{ $post->description }}</p>
                <div class="post-image " style="display: flex; justify-content:center">
                    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->name }}" width="500px">
                </div>
                 <p>Nội dung: {!! $post->content !!}</p>
            </div>
        </div>
    </div>
@endsection
