@extends('client.layouts.master')
@section('title', 'Trang chủ')
@section('styles')
    <style>
        .single-slide {
            height: 680px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .slider-text-info {
            margin-left: -150px;
            margin-top: 300px;
            color: #fff;
        }

        .single-banner img {
            width: 546px;
            height: 270px;
            border-radius: 5px;
        }

        .banner-image {
            position: relative;
            overflow: hidden;
        }

        .banner-image img {
            width: 100%;
            height: 270px;
            object-fit: cover;
            display: block;
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .banner-image:hover .banner-overlay {
            opacity: 1;
        }

        .banner-overlay h5 {
            font-size: 24px;
            margin: 0;
            text-align: center;
            color: #fff;
        }

        .carousel-control-prev,
        .carousel-control-next {
            opacity: 0;
            transition: opacity 0.3s ease;
            width: 3%;
            /* Thay đổi chiều rộng để điều chỉnh khoảng cách */
        }

        .slide:hover .carousel-control-prev,
        .slide:hover .carousel-control-next {
            opacity: 1;
        }

        .carousel-control-prev {
            left: 20px;
        }

        .carousel-control-next {
            right: 20px;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgb(167, 160, 160);
            opcity: 50%;
            padding: 15px;
            border-radius: 5px;
            font-size: 0.1px;
        }

        .carousel-control-prev-icon:after,
        .carousel-control-next-icon:after {
            color: white;
        }
    </style>


@endsection

@section('content')
    {{-- BANNER --}}
    <div class="hero-slider-box">
        <div class="container-fluid">
            <div id="heroCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                <div class="carousel-inner">
                    @foreach ($banners as $key => $banner)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <a href="{{ $banner->url }}" class="d-block w-100"
                                style="background-image: url('{{ Storage::url($banner->image) }}');">
                                <div class="single-slide">
                                    <div class="hero-content-one container">
                                        <div class="row">
                                            <div class="col">
                                                <div class="slider-text-info text-black">
                                                    {{-- Nếu bạn muốn thêm nội dung khác vào slider-text-info, có thể thêm vào đây --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    {{-- SALE --}}
    <div class="slider-bottom-inner">
        <div class="banner-area ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="banner-area-inner-tp">
                            <div class="row">
                                <div class="product-wrapper-tab-panel mt-3">
                                    <div class="product-slider">
                                        @foreach ($productsOnSale as $product)
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="{{ route('client.show', $product->id) }}">
                                                        <img class="img-fluid"
                                                            src="{{ asset('storage/' . $product->img_thumbnail) }}"
                                                            style="width: 300px; height: 250px;">
                                                    </a>
                                                    <span class="label-product label-new">new</span>

                                                    @php
                                                        $discountPercentage =
                                                            (($product->price -
                                                                $product->sales->first()->pivot->sale_price) /
                                                                $product->price) *
                                                            100;
                                                    @endphp
                                                    <span
                                                        class="label-product label-sale">-{{ round($discountPercentage, 0) }}%</span>

                                                    <div class="quick_view">
                                                        <a href="#" title="quick view" class="quick-view-btn"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                                            <i class="fa fa-search"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a
                                                            href="{{ route('client.show', $product->id) }}">{{ $product->name }}</a>
                                                    </h3>
                                                    <div class="price-box">
                                                        <span
                                                            class="old-price">{{ number_format($product->price, 0, ',', '.') }}
                                                            VNĐ</span>
                                                        <span
                                                            class="new-price">{{ number_format($product->sales->first()->pivot->sale_price, 0, ',', '.') }}
                                                            VNĐ</span>
                                                    </div>
                                                    <div class="product-action">
                                                        <button class="add-to-cart" title="Add to cart"><i
                                                                class="fa fa-plus"></i> Thêm vào giỏ hàng</button>
                                                        <div class="star_content">
                                                            <ul class="d-flex">
                                                                <li><a class="star" href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li><a class="star" href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li><a class="star" href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li><a class="star" href="#"><i
                                                                            class="fa fa-star"></i></a></li>
                                                                <li><a class="star-o" href="#"><i
                                                                            class="fa fa-star-o"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- SERVICE --}}
    <div class="our-services-area pt--60 pb--30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title section-bg-3">
                        <h2>DỊCH VỤ</h2>
                        <p>Các dịch vụ tiện ích tại FootForward</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-service-item">
                        <div class="our-service-icon">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="our-service-info">
                            <h3>Free Shipping</h3>
                            <p>Miễn phí vận chuyển các đơn trong nội thành hoặc tổng đơn trên 500k</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-service-item">
                        <div class="our-service-icon">
                            <i class="fa fa-support"></i>
                        </div>
                        <div class="our-service-info">
                            <h3>Support 24/7</h3>
                            <p>Liên hệ tới chúng tôi 24/7 mọi lúc mọi nơi</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-service-item">
                        <div class="our-service-icon">
                            <i class="fa fa-undo"></i>
                        </div>
                        <div class="our-service-info">
                            <h3>15 Days Return</h3>
                            <p>Hoàn trả hàng đơn giản trong vòng 15 ngày</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-service-item">
                        <div class="our-service-icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="our-service-info">
                            <h3>100% Payment Secure</h3>
                            <p>Chúng tôi đảm bảo với các phương thức thanh toán an toàn</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- NEW PRODUCT --}}
    <div class="product-area pb--30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="section-title section-bg-3 pt--60 border-t-one text-center ">
                        <h2>SẢN PHẨM MỚI NHẤT</h2>
                        <p>Giày xu hướng mới thời trang 2024 tại FootForward</p>
                    </div>
                </div>
            </div>
            <div class="product-wrapper-tab-panel mt-3">
                <div class="product-slider">
                    @foreach ($productsNoSale as $product)
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{ route('client.show', $product->id) }}">
                                    <img class="img-fluid" src="{{ asset('storage/' . $product->img_thumbnail) }}"
                                        style="width: 300px; height: 250px;">
                                </a>
                                <span class="label-product label-new">new</span>

                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{ route('client.show', $product->id) }}">{{ $product->name }}</a></h3>
                                <div class="price-box">
                                    <span class="new-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                </div>
                                <div class="product-action">

                                    <button class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Thêm vào giỏ hàng</button>

                                    <div class="star_content">
                                        <ul class="d-flex">
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a></li>
                                            <li><a class="star-o" href="#"><i class="fa fa-star-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    {{-- CATEGORY --}}
    <div class="our-brand-area mb--30 mt--40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title section-bg-3">
                        <h2>CHUYÊN MỤC GIÀY</h2>
                        <p>Gồm các thể loại giày xu hướng tại FootForward</p>
                    </div>
                </div>
                <div id="categoryCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <div class="carousel-inner">
                        @foreach ($categories->chunk(2) as $key => $chunk)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($chunk as $category)
                                        <div class="col-lg-6 col-md-12">
                                            <!-- single-banner start -->
                                            <div class="single-banner mt--30">
                                                <a href="{{ $category->link }}">
                                                    <div class="banner-image">
                                                        <img src="{{ $category->image }}" alt=""
                                                            style="width: 100%; height: 270px; object-fit: cover;">
                                                        <div class="banner-overlay">
                                                            <h5>{{ $category->name }}</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#categoryCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#categoryCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- POST --}}
    <div class="latest-blog-post-area section-ptb">
        <div class="container">

            <div class="row">

                <div class="col-lg-12">
                    <div class="section-title section-bg-3">
                        <h2>BÀI VIẾT ĐÁNG CHÚ Ý </h2>
                        <p>Những bài viết được đề xuất tại FootForward</p>
                    </div>
                </div>

            </div>
            <div class="latest-blog-slider">
                @foreach ($posts as $item)
                    <!-- single-latest-blog start -->
                    <div class="single-latest-blog mt--30">
                        <div class="latest-blog-image">
                            <a href="{{ route('client.post', $item->id) }}">
                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}"
                                    style="width: 330px; height: 250px;">
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
                            <p style="height: 100px; width: 330px;">{{ $item->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- BRAND --}}
    <div class="hero-slider-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title section-bg-3">
                        <h2>THƯƠNG HIỆU</h2>
                        <p>Những thương hiệu có mặt tại FootForward</p>
                    </div>
                </div>
            </div>
            <div class="row our-brand-active text-center col-1g-12" style="padding-left:200px;">
                @foreach ($brands as $brand)
                    <div class="col-lg-2">
                        <div class="single-brand ">
                            <img class="img-fluid" src="{{ $brand->image }}" alt="" width="200px"
                                height="200px">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    </div>

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            var $slides = $('.single-slide');
            var currentIndex = 0;
            var slideCount = $slides.length;

            function showSlide(index) {
                $slides.removeClass('active').eq(index).addClass('active');
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % slideCount;
                showSlide(currentIndex);
            }

            setInterval(nextSlide, 3000); // Chuyển slide mỗi 3 giây
        });
    </script>


@endsection
