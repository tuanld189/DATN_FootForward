@extends('client.layouts.master')
@section('title', 'Bài viết')
@section('styles')
<style>
    .latest-blog-post-area {
        padding-top: 50px;
        padding-bottom: 50px;
    }
    .single-latest-blog {
        display: flex;
        flex-direction: column;
        margin-bottom: 30px;
    }
    .latest-blog-image img {
        width: 100%;
        height: auto;
        max-height: 700px;
        object-fit: cover;
    }
    .latest-blog-content {
        padding: 20px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .latest-blog-content h4 {
        margin-top: 0;
    }
    .latest-blog-content .post_meta {
        margin: 10px 0;
        color: #777;
        font-size: 14px;
    }
    .latest-blog-content p {
        margin: 10px 0;
    }
</style>
@endsection
@section('content')

    <div class="latest-blog-post-area section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title section-bg-3">
                        <h2>Blog Posts</h2>
                        <p>Những bài viết mới nhất tại FootForward</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($posts as $item)
                    <div class="col-lg-12">
                        <div class="single-latest-blog mt--30">
                            <div class="latest-blog-image">
                                <a href="{{ route('client.post', $item->id) }}">
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}">
                                </a>
                            </div>
                            <div class="latest-blog-content">
                                <h4><a href="{{ route('client.post', $item->id) }}">{{ $item->name }}</a></h4>
                                <div class="post_meta">
                                    <span class="meta_date">
                                        <i class="fa fa-calendar"></i> {{ $item->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="meta_author">
                                        <i class="fa fa-user"></i> {{ Auth::check() ? Auth::user()->name : '' }}
                                    </span>
                                </div>
                                <p>{{ $item->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
