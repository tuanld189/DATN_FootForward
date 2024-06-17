@extends('users.layout.inheritance')
@section('content')
    <style>
        .single-product {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            position: relative;
            transition: box-shadow 0.3s ease;
        }

        .single-product:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            position: relative;
        }

        .product-details {
            padding: 15px;
            text-align: center;
        }

        .product-details h6 {
            font-size: 18px;
            margin: 10px 0;
        }

        .price {
            margin: 10px 0;
        }

        .price h6 {
            font-size: 20px;
            color: #ff5722;
            margin: 0;
        }

        .price .l-through {
            text-decoration: line-through;
            color: #999;
            font-size: 16px;
        }

        .prd-bottom {
            display: flex;
            justify-content: space-around;
            padding: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
            position: absolute;
            bottom: 0px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            background-color: rgba(0, 0, 0, 0.2);
            /* Semi-transparent background */
        }

        .product-image:hover .prd-bottom {
            opacity: 1;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            padding: 10px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
            color: white;
            font-size: 14px;
            background-color: transparent;
            /* Make buttons transparent */
            flex: 1;
            margin: 0 5px;
            font-weight: bold;
            white-space: nowrap;
            /* Ensure buttons do not wrap text */
        }

        .btn img {
            display: block;
            filter: brightness(0) invert(1);
            /* Make the icon white */
        }

        .btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            /* Lighten the background on hover */
            color: white;
            /* Ensure text color remains white on hover */
        }

        .btn-action {
            background-color: transparent;
        }

        .btn-action:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            /* Ensure text color remains white on hover */
        }
    </style>
    <!-- start banner Area -->
    <section class="banner-area ">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start mt-3">
                <div class="col-lg-12">
                    <div class="active-banner-slider owl-carousel">
                        <!-- single-slide -->
                        <div class="row single-slide align-items-center d-flex">
                            <img class="img-fluid" src="{{ asset('images/banner-02.png') }}" alt="">
                            {{-- <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h1>Nike New <br>Collection!</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                <!-- <div class="add-bag d-flex align-items-center">
                                    <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                                    <span class="add-text text-uppercase">Add to Bag</span>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" src="{{ asset('images/banner/banner-img.png') }}" alt="">
                            </div>
                        </div> --}}
                        </div>
                        <!-- single-slide -->
                        <div class="row single-slide">
                            <img class="img-fluid" src="{{ asset('images/banner-03.png') }}" alt="">
                            {{-- <div class="col-lg-5">
                            <div class="banner-content">
                                <h1>Nike New <br>Collection!</h1>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                <!-- <div class="add-bag d-flex align-items-center">
                                    <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                                    <span class="add-text text-uppercase">Add to Bag</span>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" src="{{ asset('images/banner/banner-img.png') }}" alt="">
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End banner Area -->
    <!-- start features Area -->
    <section class="features-area section_gap">
        <div class="container">
            <div class=" text-center">

                <h1 style="font-family: 'Courier New', Courier, monospace">DỊCH VỤ</h1>
                {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore
                    magna aliqua.</p> --}}

            </div>
            <div class="row features-inner">

                <!-- single features -->
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{ asset('images/features/f-icon1.png') }}" alt="Feature Icon">

                        </div>
                        <h6>Free Ship</h6>
                        <p>Miễn phí ship khi order sản phẩm</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{ asset('images/features/f-icon2.png') }}" alt="">
                        </div>
                        <h6>Hoản trả</h6>
                        <p>Hoản trả hàng khi gặp vấn đề</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{ asset('images/features/f-icon3.png') }}" alt="">
                        </div>
                        <h6>24/7 Support</h6>
                        <p>Tư vấn, chăm sóc khách hàng</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{ asset('images/features/f-icon4.png') }}" alt="">
                        </div>
                        <h6>Thanh toán</h6>
                        <p>Online hay Offline điều được</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end features Area -->

    <!-- Start category Area -->
    <section class="category-area">
        <div class="container">
            <div class=" text-center mb-3">

                <h1 style="font-family: 'Courier New', Courier, monospace">DANH MỤC</h1>
                {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                labore et dolore
                magna aliqua.</p> --}}

            </div>
            <div class="row justify-content-center">

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="{{ asset('images/category/c1.jpg') }}" alt="">
                                <a href="img/category/c1.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Sneaker for Sports</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="{{ asset('images/category/c2.jpg') }}" alt="">
                                <a href="img/category/c2.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Sneaker for Sports</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="{{ asset('images/category/c3.jpg') }}" alt="">
                                <a href="img/category/c3.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Product for Couple</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100" src="{{ asset('images/category/c4.jpg') }}" alt="">
                                <a href="img/category/c4.jpg" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title">Sneaker for Sports</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-deal">
                        <div class="overlay"></div>
                        <img class="img-fluid w-100" src="{{ asset('images/category/c5.jpg') }}" alt="">
                        <a href="img/category/c5.jpg" class="img-pop-up" target="_blank">
                            <div class="deal-details">
                                <h6 class="deal-title">Sneaker for Sports</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End category Area -->

    <!-- start product Area -->
    <section class="owl-carousel active-product-area section_gap">
        <!-- single product slide -->
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1 style="font-family: 'Courier New', Courier, monospace">SẢN PHẨM MỚI</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et
                                dolore
                                magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($products as $product)
                        <!-- single product -->
                        <div class="col-lg-3 col-md-6">

                            <div class="single-product">
                                <a href="{{ route('users.show', $product->id) }}"><img class="img-fluid"
                                        src="{{ Storage::url($product->img_thumbnail) }}" alt=""></a>
                                <div class="product-details">
                                    <h6>{{ $product->name }}</h6>
                                    <div class="price">
                                        <h6>{{ $product->price }}$</h6>
                                        {{-- <h6 class="l-through">$210.00</h6> --}}
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- single product slide -->
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Coming Products</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et
                                dolore
                                magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="{{ asset('images/product/p6.jpg') }}" alt="">
                            <div class="product-details">
                                <h6>addidas New Hammer sole
                                    for Sports person</h6>
                                <div class="price">
                                    <h6>$150.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                                <div class="prd-bottom">

                                    <a href="" class="social-info">
                                        <span class="ti-bag"></span>
                                        <p class="hover-text">add to bag</p>
                                    </a>
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-sync"></span>
                                        <p class="hover-text">compare</p>
                                    </a>
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-move"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single product -->
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="{{ asset('images/product/p8.jpg') }}" alt="">
                            <div class="product-details">
                                <h6>addidas New Hammer sole
                                    for Sports person</h6>
                                <div class="price">
                                    <h6>$150.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                                <div class="prd-bottom">

                                    <a href="" class="social-info">
                                        <span class="ti-bag"></span>
                                        <p class="hover-text">add to bag</p>
                                    </a>
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-heart"></span>
                                        <p class="hover-text">Wishlist</p>
                                    </a>
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-sync"></span>
                                        <p class="hover-text">compare</p>
                                    </a>
                                    <a href="" class="social-info">
                                        <span class="lnr lnr-move"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- end product Area -->

    <!-- Start exclusive deal Area -->
    <section class="exclusive-deal-area">
        <div class=" text-center">

            <h1 style="font-family: 'Courier New', Courier, monospace">SẢN PHẨM KHUYẾN MẠI</h1>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
            labore et dolore
            magna aliqua.</p> --}}

        </div>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 no-padding exclusive-left">
                    <div class="row clock_sec clockdiv" id="clockdiv">
                        <div class="col-lg-12">
                            <h1>Exclusive Hot Deal Ends Soon!</h1>
                            <p>Who are in extremely love with eco friendly system.</p>
                        </div>
                        <div class="col-lg-12">
                            <div class="row clock-wrap">
                                <div class="col clockinner1 clockinner">
                                    <h1 class="days">150</h1>
                                    <span class="smalltext">Days</span>
                                </div>
                                <div class="col clockinner clockinner1">
                                    <h1 class="hours">23</h1>
                                    <span class="smalltext">Hours</span>
                                </div>
                                <div class="col clockinner clockinner1">
                                    <h1 class="minutes">47</h1>
                                    <span class="smalltext">Mins</span>
                                </div>
                                <div class="col clockinner clockinner1">
                                    <h1 class="seconds">59</h1>
                                    <span class="smalltext">Secs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="" class="primary-btn">Shop Now</a>
                </div>
                <div class="col-lg-6 no-padding exclusive-right">
                    <div class="active-exclusive-product-slider">
                        <!-- single exclusive carousel -->
                        <div class="single-exclusive-slider">
                            <img class="img-fluid" src="{{ asset('images/product/e-p1.png') }}" alt="">
                            <div class="product-details">
                                <div class="price">
                                    <h6>$150.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                                <h4>addidas New Hammer sole
                                    for Sports person</h4>
                                <div class="add-bag d-flex align-items-center justify-content-center">


                                </div>
                            </div>
                        </div>
                        <!-- single exclusive carousel -->
                        <div class="single-exclusive-slider">
                            <img class="img-fluid" src="{{ asset('images/product/e-p1.png') }}" alt="">
                            <div class="product-details">
                                <div class="price">
                                    <h6>$150.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                                <h4>addidas New Hammer sole
                                    for Sports person</h4>
                                <div class="add-bag d-flex align-items-center justify-content-center">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End exclusive deal Area -->

    <!-- Start brand Area -->
    <section class="brand-area section_gap">
        <div class=" text-center">

            <h1 style="font-family: 'Courier New', Courier, monospace">BRAND</h1>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
            labore et dolore
            magna aliqua.</p> --}}

        </div>
        <div class="container">
            <div class="row">

                @foreach ($brands as $brand)
                    <a class="col single-img" href="#">
                        <img class="img-fluid d-block mx-auto" src="{{ Storage::url($brand->image) }}" alt="">
                    </a>
                @endforeach






                {{-- <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="{{ asset('images/Imagecut/logoadidass.png') }}" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="{{ asset('images/Imagecut/logopuma.jfif') }}" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="{{ asset('images/Imagecut/logoadidas.jfif') }}" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="{{ asset('images/Imagecut/logobitis.jfif') }}" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="{{ asset('images/Imagecut/logoadidass.png') }}" alt="">
            </a> --}}
            </div>
        </div>
    </section>
    <!-- End brand Area -->

    <!-- Start related-product Area -->
    <section class="related-product-area section_gap_bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Deals of the Week</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore
                            magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="{{ asset('images/r1.jpg') }}" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ctg-right">
                        <a href="#" target="_blank">
                            <img class="img-fluid d-block mx-auto" src="{{ asset('images/category/c5.jpg') }}"
                                alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End related-product Area -->

    <!-- Start Post Area -->
    <section class="brand-area section_gap">
        <div class=" text-center">

            <h1 style="font-family: 'Courier New', Courier, monospace">BLOG</h1>

        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-3 card" style="width: 18rem;">
                    <img src="{{asset('images/product/p1.jpg')}}" class="card-img-top" alt="Image description">
                    <div class="card-body">
                        <h5 class="card-title">Giày thể thao đa năng "FlexRun 2024"</h5>
                        <p class="card-category">Giày thể thao</p>
                    </div>
                </div>
                <div class="col-lg-3 card" style="width: 18rem;">
                    <img src="{{asset('images/product/p1.jpg')}}" class="card-img-top" alt="Image description">
                    <div class="card-body">
                        <h5 class="card-title">Giày thể thao đa năng "FlexRun 2024"</h5>
                        <p class="card-category">Giày thể thao</p>
                    </div>
                </div>
                <div class="col-lg-3 card" style="width: 18rem;">
                    <img src="{{asset('images/product/p1.jpg')}}" class="card-img-top" alt="Image description">
                    <div class="card-body">
                        <h5 class="card-title">Giày thể thao đa năng "FlexRun 2024"</h5>
                        <p class="card-category">Giày thể thao</p>
                    </div>
                </div>
                {{-- @foreach ($posts as $item)
                    <div class="card" style="width: 18rem; margin: 10px;">
                        <img src="{{ Storage::url($item->image) }}" class="card-img-top" alt="Image description">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-category">{{ $item->category }}</p>
                        </div>
                    </div>
                @endforeach --}}

            </div>
        </div>
    </section>

    <!-- End Post Area -->
@endsection
