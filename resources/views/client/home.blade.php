@extends('client.layout.inheritance')
@section('content')
    <div class="container-box-inner">
        <!-- Hero Slider start -->
        <div class="hero-slider-box">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="hero-slider hero-slider-two">
                            <div class="single-slide" style="background-image: url(assets/images/slider/slider-h2-bg-1.jpg)">
                                <!-- Hero Content One Start -->
                                <div class="hero-content-one container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="slider-text-info">
                                                <h1>Sketchman Shoes Sport</h1>
                                                <h1>Street Style</h1>
                                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat</p>
                                                <a href="shop.html" class="btn slider-btn uppercase"><span><i
                                                            class="fa fa-plus"></i> Shop Now</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hero Content One End -->
                            </div>
                            <div class="single-slide"
                                style="background-image: url({{ asset('assets/images/slider/slider-h2-bg-2.jpg') }})">
                                <!-- Hero Content One Start -->
                                <div class="hero-content-one container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="slider-text-info">
                                                <h1>Classic Leather Handbags</h1>
                                                <h1>Amazing Men's</h1>
                                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat</p>
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

        <!-- Our Services Area Start -->
        <div class="our-services-area section-pt-70">
            <div class="container">
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

        <!-- Banner area start -->
        <div class="banner-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <!-- single-banner start -->
                        <div class="single-banner mt--30">
                            <a href="shop.html"><img src="asset('assets/images/banner/1.jpg')" alt=""></a>
                        </div>
                        <!-- single-banner end -->
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <!-- single-banner start -->
                        <div class="single-banner mt--30">
                            <a href="shop.html"><img src="asset('assets/images/banner/2.jpg')" alt=""></a>
                        </div>
                        <!-- single-banner end -->
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <!-- single-banner start -->
                        <div class="single-banner mt--30">
                            <a href="shop.html"><img src="asset('assets/images/banner/3.jpg')" alt=""></a>
                        </div>
                        <!-- single-banner end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner area end -->

        <!-- Product Area Start -->
        <div class="product-area section-pt section-pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- section-title start -->
                        <div class="section-title">
                            <h2>New Product </h2>
                            <p>Most Summmer 2024</p>
                        </div>
                        <!-- section-title end -->
                    </div>
                </div>
                <!-- product-wrapper start -->
                <div class="product-wrapper">
                    <div class="product-slider">
                        <!-- single-product-wrap start -->
                        @foreach ($products as $product)
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{ route('client.show', $product->id) }}"><img class="img-fluid"
                                        src="{{ Storage::url($product->img_thumbnail) }}" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-7%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn"
                                        data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{ route('client.show', $product->id) }}">{{ $product->name }}</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$51.27</span>
                                    <span class="old-price">${{ $product->price }}</span>
                                </div>
                                <div class="product-action">
                                    <button class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Add
                                        to cart</button>
                                    <div class="star_content">
                                        <ul class="d-flex">
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li><a class="star" href="#"><i class="fa fa-star"></i></a>
                                            </li>
                                            <li><a class="star-o" href="#"><i class="fa fa-star-o"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- single-product-wrap end -->
                    </div>
                </div>
                <!-- Product Area End -->

                <!-- Banner area start -->
                <div class="banner-area-two">
                    <div class="container-fluid plr-40">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <!-- single-banner start -->
                                <div class="single-banner-two mt--30">
                                    <a href="shop.html"><img src="assets/images/banner/bg4.jpg" alt=""></a>
                                </div>
                                <!-- single-banner end -->
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <!-- single-banner start -->
                                <div class="single-banner-two mt--30">
                                    <a href="shop.html"><img src="assets/images/banner/bg3.jpg" alt=""></a>
                                </div>
                                <!-- single-banner end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banner area end -->

                <!-- Trending Product Area Start -->
                <div class="trending-products-area section-pt-70">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="single-trend-cetagory mt--30">
                                    <div class="section-title-three">
                                        <h3>Earrings</h3>
                                    </div>
                                    <div class="trend-product-active">
                                        <!-- trend-product-wrap start -->
                                        <div class="col trend-product-wrap">
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/1.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">New Mix Material</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$77.56</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/3.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Summer Dress</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$86.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/5.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress Mix</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$44.22</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/7.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress1</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$35.12</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                        </div>
                                        <!-- trend-product-wrap end -->
                                        <!-- trend-product-wrap start -->
                                        <div class="col trend-product-wrap">
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/1.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">New Mix Material</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$77.56</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/3.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Summer Dress</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$86.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/5.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress Mix</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$44.22</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/7.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress1</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$35.12</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                        </div>
                                        <!-- trend-product-wrap end -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-trend-cetagory mt--30">
                                    <div class="section-title-three">
                                        <h3>Necklaces</h3>
                                    </div>
                                    <div class=" trend-product-active">
                                        <!-- trend-product-wrap start -->
                                        <div class="col trend-product-wrap">
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/2.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Monki Bear Fur</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$55.56</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/4.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress1</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$33.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/6.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress1 mix</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$12.22</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/9.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">New Mix Dress</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$35.12</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                        </div>
                                        <!-- trend-product-wrap end -->
                                        <!-- trend-product-wrap start -->
                                        <div class="col trend-product-wrap">
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/4.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">New Mix Material</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$77.56</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/9.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Summer Dress</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$86.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/2.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress Mix</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$44.22</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/1.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress1</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$35.12</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                        </div>
                                        <!-- trend-product-wrap end -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-trend-cetagory mt--30">
                                    <div class="section-title-three">
                                        <h3>Bracelets</h3>
                                    </div>
                                    <div class=" trend-product-active">
                                        <!-- trend-product-wrap start -->
                                        <div class="col trend-product-wrap">
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/10.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">New Mix Material</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$77.56</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/9.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Summer Dress</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$86.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/7.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress Mix</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$44.22</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/3.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress1</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$35.12</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                        </div>
                                        <!-- trend-product-wrap end -->
                                        <!-- trend-product-wrap start -->
                                        <div class="col trend-product-wrap">
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/7.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">New Mix Material</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$77.56</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/4.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Summer Dress</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$86.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/8.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress Mix</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$44.22</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                            <!-- trend-single-product start -->
                                            <div class="trend-single-product">
                                                <div class="trend-product-image">
                                                    <a href="porduct-details.html"><img
                                                            src="{{ asset('assets/images/product/1.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="trend-product-content">
                                                    <h3><a href="#">Printed Dress1</a></h3>
                                                    <div class="price-box">
                                                        <span class="new-price">$35.12</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- trend-single-product end -->
                                        </div>
                                        <!-- trend-product-wrap end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Trending Product Area end -->

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
                        <div class="row our-brand-active text-center">
                            <div class="col-12">
                                <div class="single-brand">
                                    <a href="#"><img src="{{ asset('assets/images/brands/1.png') }}"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-brand">
                                    <a href="#"><img src="{{ asset('assets/images/brand/2.png') }}"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-brand">
                                    <a href="#"><img src="{{ asset('assets/images/brand/3.png') }}"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-brand">
                                    <a href="#"><img src="{{ asset('assets/images/brand/4.png') }}"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-brand">
                                    <a href="#"><img src="{{ asset('assets/images/brand/5.png') }}"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="single-brand">
                                    <a href="#"><img src="{{ asset('assets/images/brand/6.png') }}"
                                            alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Our Brand Area End -->
            </div>
        @endsection
