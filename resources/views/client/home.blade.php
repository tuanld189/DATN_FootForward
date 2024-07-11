@extends('client.layouts.master')
@section('title', 'Trang chủ')
@section('content')
    <div class="hero-slider-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="hero-slider hero-slider-one">
                        <div class="single-slide" style="background-image: url(assets/images/slider/slider-home5-1.jpg)">
                            <!-- Hero Content One Start -->
                            <div class="hero-content-one container">
                                <div class="row">
                                    <div class="col">
                                        <div class="slider-text-info text-black">
                                            <h1>Classic Leather Accessories </h1>
                                            <h1>Amazing For Men's</h1>
                                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                                eu fugiat nulla pariatur. Excepteur sint occaecat</p>
                                            <a href="shop.html" class="btn slider-btn uppercase"><span><i
                                                        class="fa fa-plus"></i> Shop Now</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hero Content One End -->
                        </div>
                        <div class="single-slide" style="background-image: url(assets/images/slider/slider-home5-2.jpg)">
                            <!-- Hero Content One Start -->
                            <div class="hero-content-one container">
                                <div class="row">
                                    <div class="col">
                                        <div class="slider-text-info text-black">
                                            <h1>Spring Men's T-Shirt</h1>
                                            <h1>Amazing Men's</h1>
                                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                                eu fugiat nulla pariatur. Excepteur sint occaecat</p>
                                            <a href="shop.html" class="btn slider-btn uppercase"><span><i
                                                        class="fa fa-plus"></i> SHOP NOW</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hero Content One End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Slider end -->

    <div class="slider-bottom-inner">
        <!-- Banner area start -->
        <div class="banner-area ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="banner-area-inner-tp">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <!-- single-banner start -->
                                    <div class="single-banner mt--30">
                                        <a href="shop.html"><img src="assets/images/banner/1.jpg" alt=""></a>
                                    </div>
                                    <!-- single-banner end -->
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <!-- single-banner start -->
                                    <div class="single-banner mt--30">
                                        <a href="shop.html"><img src="assets/images/banner/2.jpg" alt=""></a>
                                    </div>
                                    <!-- single-banner end -->
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <!-- single-banner start -->
                                    <div class="single-banner mt--30">
                                        <a href="shop.html"><img src="assets/images/banner/3.jpg" alt=""></a>
                                    </div>
                                    <!-- single-banner end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner area end -->
    </div>

    <!-- Our Services Area Start -->
    <div class="our-services-area pt--60 pb--30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title section-bg-3">
                        <h2>Service</h2>
                        {{-- <p>There are latest blog posts</p> --}}
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <!-- single-service-item start -->
                    <div class="single-service-item">
                        <div class="our-service-icon">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="our-service-info">
                            <h3>Free Shipping</h3>
                            <p>Free shipping on all US order or order above $200</p>
                        </div>
                    </div>
                    <!-- single-service-item end -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- single-service-item start -->
                    <div class="single-service-item">
                        <div class="our-service-icon">
                            <i class="fa fa-support"></i>
                        </div>
                        <div class="our-service-info">
                            <h3>Support 24/7</h3>
                            <p>Contact us 24 hours a day, 7 days a week</p>
                        </div>
                    </div>
                    <!-- single-service-item end -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- single-service-item start -->
                    <div class="single-service-item">
                        <div class="our-service-icon">
                            <i class="fa fa-undo"></i>
                        </div>
                        <div class="our-service-info">
                            <h3>30 Days Return</h3>
                            <p>Simply return it within 30 days for an exchange</p>
                        </div>
                    </div>
                    <!-- single-service-item end -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <!-- single-service-item start -->
                    <div class="single-service-item">
                        <div class="our-service-icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="our-service-info">
                            <h3>100% Payment Secure</h3>
                            <p>We ensure secure payment with PEV</p>
                        </div>
                    </div>
                    <!-- single-service-item end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Services Area End -->

    <!-- Product Area Start -->
    <div class="product-area pb--30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title-two pt--60 border-t-one text-center">
                        <h2>Popular Products</h2>
                        <p>Most Trendy 2024 Clother</p>
                    </div>
                    <!-- section-title end -->
                </div>
                {{-- <div class="col-12">
                    <div class="tabs-categorys-list">
                        <ul class="nav justify-content-center" role="tablist">
                            <li class="active"><a class="active" href="#arrival" role="tab" data-bs-toggle="tab">New
                                    Arrival</a></li>
                            <li><a href="#onsale" role="tab" data-bs-toggle="tab">OnSale</a></li>
                            <li><a href="#featured" role="tab" data-bs-toggle="tab">Featured Products</a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
            <!-- product-wrapper start -->
            <div class="product-wrapper-tab-panel">
                <!-- tab-contnt start -->
                <div class="product-slider">
                    <!-- single-product-wrap start -->
                    @foreach ($products as $product)
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{ route('client.show', $product->id) }}">
                                    <img class="img-fluid" src="{{ asset('storage/' . $product->img_thumbnail) }}" >
                                </a>
                                <span class="label-product label-new">new</span>

                                @if ($product->sales->isNotEmpty() && $product->sales->first()->pivot && $product->sales->first()->status)
                                    @php
                                        $discountPercentage =
                                            (($product->price - $product->sales->first()->pivot->sale_price) /
                                                $product->price) *
                                            100;
                                    @endphp
                                    <span class="label-product label-sale">-{{ round($discountPercentage, 0) }}%</span>
                                @endif

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
                                    @if ($product->sales->isNotEmpty() && $product->sales->first()->pivot && $product->sales->first()->status)
                                        <span class="old-price">{{ number_format($product->price, 0, ',', '.') }}
                                            VNĐ</span>
                                        <span
                                            class="new-price">{{ number_format($product->sales->first()->pivot->sale_price, 0, ',', '.') }}
                                            VNĐ</span>
                                    @else
                                        <span class="new-price">{{ number_format($product->price, 0, ',', '.') }}
                                            VNĐ</span>
                                    @endif
                                </div>
                                <div class="product-action">
                                    <button class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Add to
                                        cart</button>
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

                    <!-- single-product-wrap end -->
                </div>


                <!-- tab-contnt end -->
            </div>
            <!-- product-wrapper end -->
        </div>
    </div>
    <!-- Product Area End -->

    <!-- Banner area start -->
    <div class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <!-- single-banner start -->
                    <div class="single-banner mt--30">
                        <a href="shop.html"><img src="assets/images/banner/bg4.jpg" alt=""></a>
                    </div>
                    <!-- single-banner end -->
                </div>
                <div class="col-lg-6 col-md-12">
                    <!-- single-banner start -->
                    <div class="single-banner mt--30">
                        <a href="shop.html"><img src="assets/images/banner/bg11.jpg" alt=""></a>
                    </div>
                    <!-- single-banner end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Banner area end -->

 

    {{-- Category --}}

    <div class="our-brand-area mb--30 mt--40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title section-bg-3">
                        <h2>Categories</h2>
                        {{-- <p>There are latest blog posts</p> --}}
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <div class="row our-brand-active text-center">
                @foreach ($categories as $cate)
                    <div class="col-12">
                        <div class="single-brand ">
                            <img class="img-fluid" src="{{ $cate->image }}" alt="" width="300px"
                                height="400px">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    {{-- End Cate --}}

    <!-- Latest Blog Posts Area start -->
    <div class="latest-blog-post-area section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title section-bg-3">
                        <h2>Latest Blog Posts </h2>
                        <p>There are latest blog posts</p>
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <div class="latest-blog-slider">
                <!-- single-latest-blog start -->
                <div class="single-latest-blog mt--30">
                    <div class="latest-blog-image">
                        <a href="blog-details.html">
                            <img src="{{ asset('assets/images/blog/1.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="latest-blog-content">
                        <h4><a href="blog-details.html">Work with customizer</a></h4>
                        <div class="post_meta">
                            <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>Mar 05,
                                2018</span>
                            <span class="meta_author"><span></span>Demo Name</span>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has
                            been the industrys standard dummy text ever since the ...</p>
                    </div>
                </div>
                <!-- single-latest-blog end -->
                <!-- single-latest-blog start -->
                <div class="single-latest-blog mt--30">
                    <div class="latest-blog-image">
                        <a href="blog-details.html">
                            <img src="{{ asset('assets/images/blog/2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="latest-blog-content">
                        <h4><a href="blog-details.html">Go to New Horizonts</a></h4>
                        <div class="post_meta">
                            <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>may 17,
                                2018</span>
                            <span class="meta_author"><span></span>Demo Name</span>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has
                            been the industrys standard dummy text ever since the ...</p>
                    </div>
                </div>
                <!-- single-latest-blog end -->
                <!-- single-latest-blog start -->
                <div class="single-latest-blog mt--30">
                    <div class="latest-blog-image">
                        <a href="blog-details.html">
                            <img src="{{ asset('assets/images/blog/3.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="latest-blog-content">
                        <h4><a href="blog-details.html">What is Bootstrap?</a></h4>
                        <div class="post_meta">
                            <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>june 11,
                                2018</span>
                            <span class="meta_author"><span></span>Demo Name</span>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has
                            been the industrys standard dummy text ever since the ...</p>
                    </div>
                </div>
                <!-- single-latest-blog end -->
                <!-- single-latest-blog start -->
                <div class="single-latest-blog mt--30">
                    <div class="latest-blog-image">
                        <a href="blog-details.html">
                            <img src="{{ asset('assets/images/blog/4.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="latest-blog-content">
                        <h4><a href="blog-details.html">Try comfort work </a></h4>
                        <div class="post_meta">
                            <span class="meta_date"><span> <i class="fa fa-calendar"></i></span>Mar 13,
                                2018</span>
                            <span class="meta_author"><span></span>Demo Name</span>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                            Ipsum has
                            been the industrys standard dummy text ever since the ...</p>
                    </div>
                </div>
                <!-- single-latest-blog end -->
            </div>
        </div>
    </div>
    <!-- Latest Blog Posts Area End -->


     <!-- Our Brand Area Start -->
     <div class="our-brand-area mb--30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title section-bg-3">
                        <h2>Brands</h2>
                        {{-- <p>There are latest blog posts</p> --}}
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <div class="row our-brand-active text-center">
                @foreach ($brands as $brand)
                    <div class="col-12">
                        <div class="single-brand ">
                            <img class="img-fluid" src="{{ $brand->image }}" alt="" width="100px"
                                height="100px">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    {{-- End brand --}}



    <!-- Our Brand Area End -->
    </div>


@endsection
