<!DOCTYPE html>
<html lang="zxx" class="no-js">
<style>
    .banner-area {
        position: relative;
        width: 100%;
        height: 50vh;
        /* Or desired height */
        background-color: white;
        /* White background color */
        overflow: hidden;
    }

    .banner-area::before,
    .banner-area::after {
        content: '';
        position: absolute;
        background: linear-gradient(to bottom right, #ff4500, #ffd700);
        transform: skewX(-45deg);
    }

    .banner-area::before {
        top: -10%;
        left: 20%;
        width: 100%;
        height: 120%;
    }

    .banner-area::after {
        top: 20%;
        left: 60%;
        width: 80%;
        height: 80%;
    }

    .line {
        position: absolute;
        background: linear-gradient(to bottom right, #ff4500, #ffd700);
        transform: skewX(-45deg);
    }

    .line:nth-child(1) {
        top: 60%;
        left: 25%;
        width: 10%;
        height: 15%;
    }

    .line:nth-child(2) {
        top: 65%;
        left: 35%;
        width: 8%;
        height: 15%;
    }

    .line:nth-child(3) {
        top: 70%;
        left: 45%;
        width: 6%;
        height: 15%;
    }

    .organic-breadcrum {
        margin-bottom: 50px;
    }

    /* css products */
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

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Karma Shop</title>

    <!--
            CSS
            ============================================= -->
    <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.skinFlat.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
</head>

<body id="category">

    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ url('/users/home') }}"><img src="{{ asset('images/logo_ff.png') }}" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="{{ url('/users/home') }}">Home</a></li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/users/categories') }}">Shop Category</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/single-product') }}">Product Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/checkout') }}">Product Checkout</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/cart') }}">Shopping Cart</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/confirmation') }}">Confirmation</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/blog') }}">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/single-blog') }}">Blog Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/tracking') }}">Tracking</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/elements') }}">Elements</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item"><a href="#" class="cart"><span class="fal fa-shopping-bag"><img src="{{ asset('images/Imagecut/Giohang.png') }}" alt=""></span></a>
                            </li>
                            <li class="nav-item">
                                <button class="search"><span class="lnr lnr-magnifier" id="search"><img src="{{ asset('images/Imagecut/Timkiem.png') }}" alt=""></span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"><img src="{{ asset('images/Imagecut/dauxx.png') }}" alt=""></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shop Category page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home</a>
                        <a href="#">Shop</span></a>
                        <a href="category.html">Fashon Category</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Browse Categories</div>
                    <ul class="main-categories">
                        <li class="main-nav-list"><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false" aria-controls="fruitsVegetable"><span class="lnr lnr-arrow-right"></span>Fruits and Vegetables<span class="number">(53)</span></a>
                            <ul class="collapse" id="fruitsVegetable" data-toggle="collapse" aria-expanded="false" aria-controls="fruitsVegetable">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a></li>
                            </ul>
                        </li>

                        <li class="main-nav-list"><a data-toggle="collapse" href="#meatFish" aria-expanded="false" aria-controls="meatFish"><span class="lnr lnr-arrow-right"></span>Meat and Fish<span class="number">(53)</span></a>
                            <ul class="collapse" id="meatFish" data-toggle="collapse" aria-expanded="false" aria-controls="meatFish">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a></li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a data-toggle="collapse" href="#cooking" aria-expanded="false" aria-controls="cooking"><span class="lnr lnr-arrow-right"></span>Cooking<span class="number">(53)</span></a>
                            <ul class="collapse" id="cooking" data-toggle="collapse" aria-expanded="false" aria-controls="cooking">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a></li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a data-toggle="collapse" href="#beverages" aria-expanded="false" aria-controls="beverages"><span class="lnr lnr-arrow-right"></span>Beverages<span class="number">(24)</span></a>
                            <ul class="collapse" id="beverages" data-toggle="collapse" aria-expanded="false" aria-controls="beverages">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a></li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a data-toggle="collapse" href="#homeClean" aria-expanded="false" aria-controls="homeClean"><span class="lnr lnr-arrow-right"></span>Home and Cleaning<span class="number">(53)</span></a>
                            <ul class="collapse" id="homeClean" data-toggle="collapse" aria-expanded="false" aria-controls="homeClean">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a></li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a href="#">Pest Control<span class="number">(24)</span></a></li>
                        <li class="main-nav-list"><a data-toggle="collapse" href="#officeProduct" aria-expanded="false" aria-controls="officeProduct"><span class="lnr lnr-arrow-right"></span>Office Products<span class="number">(77)</span></a>
                            <ul class="collapse" id="officeProduct" data-toggle="collapse" aria-expanded="false" aria-controls="officeProduct">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a></li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a data-toggle="collapse" href="#beauttyProduct" aria-expanded="false" aria-controls="beauttyProduct"><span class="lnr lnr-arrow-right"></span>Beauty Products<span class="number">(65)</span></a>
                            <ul class="collapse" id="beauttyProduct" data-toggle="collapse" aria-expanded="false" aria-controls="beauttyProduct">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a></li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a data-toggle="collapse" href="#healthProduct" aria-expanded="false" aria-controls="healthProduct"><span class="lnr lnr-arrow-right"></span>Health Products<span class="number">(29)</span></a>
                            <ul class="collapse" id="healthProduct" data-toggle="collapse" aria-expanded="false" aria-controls="healthProduct">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a></li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a href="#">Pet Care<span class="number">(29)</span></a></li>
                        <li class="main-nav-list"><a data-toggle="collapse" href="#homeAppliance" aria-expanded="false" aria-controls="homeAppliance"><span class="lnr lnr-arrow-right"></span>Home Appliances<span class="number">(15)</span></a>
                            <ul class="collapse" id="homeAppliance" data-toggle="collapse" aria-expanded="false" aria-controls="homeAppliance">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat<span class="number">(11)</span></a></li>
                            </ul>
                        </li>
                        <li class="main-nav-list"><a class="border-bottom-0" data-toggle="collapse" href="#babyCare" aria-expanded="false" aria-controls="babyCare"><span class="lnr lnr-arrow-right"></span>Baby Care<span class="number">(48)</span></a>
                            <ul class="collapse" id="babyCare" data-toggle="collapse" aria-expanded="false" aria-controls="babyCare">
                                <li class="main-nav-list child"><a href="#">Frozen Fish<span class="number">(13)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Dried Fish<span class="number">(09)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Fresh Fish<span class="number">(17)</span></a></li>
                                <li class="main-nav-list child"><a href="#">Meat Alternatives<span class="number">(01)</span></a></li>
                                <li class="main-nav-list child"><a href="#" class="border-bottom-0">Meat<span class="number">(11)</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-filter mt-50">
                    <div class="top-filter-head">Product Filters</div>
                    <div class="common-filter">
                        <div class="head">Brands</div>
                        <form action="#">
                            <ul>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">Apple<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="asus" name="brand"><label for="asus">Asus<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="gionee" name="brand"><label for="gionee">Gionee<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="micromax" name="brand"><label for="micromax">Micromax<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="samsung" name="brand"><label for="samsung">Samsung<span>(19)</span></label></li>
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Color</div>
                        <form action="#">
                            <ul>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather" name="color"><label for="balckleather">Black
                                        Leather<span>(29)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="blackred" name="color"><label for="blackred">Black
                                        with red<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
                                <li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey" name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
                            </ul>
                        </form>
                    </div>
                    <div class="common-filter">
                        <div class="head">Price</div>
                        <div class="price-range-area">
                            <div id="price-range"></div>
                            <div class="value-wrapper d-flex">
                                <div class="price">Price:</div>
                                <span>$</span>
                                <div id="lower-value"></div>
                                <div class="to">to</div>
                                <span>$</span>
                                <div id="upper-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting">
                        <select>
                            <option value="1">Default sorting</option>
                            <option value="1">Default sorting</option>
                            <option value="1">Default sorting</option>
                        </select>
                    </div>
                    <div class="sorting mr-auto">
                        <select>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                        </select>
                    </div>
                    <div class="pagination">
                        <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        <a href="#">6</a>
                        <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        <!-- single product -->

                        <!-- single product -->
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <div class="product-image">
                                    <img class="img-fluid" src="{{asset('images/product/p6.jpg')}}" alt="">
                                    <div class="prd-bottom">
                                        <a href="#" class="btn btn-action">
                                            Thêm
                                        </a>
                                        <a href="#" class="btn btn-action">
                                            Tym
                                        </a>
                                    </div>
                                </div>
                                <div class="product-details">
                                    <h6>addidas New Hammer sole for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <div class="product-image">
                                    <img class="img-fluid" src="{{asset('images/product/p6.jpg')}}" alt="">
                                    <div class="prd-bottom">
                                        <a href="#" class="btn btn-action">
                                            Thêm
                                        </a>
                                        <a href="#" class="btn btn-action">
                                            Tym
                                        </a>
                                    </div>
                                </div>
                                <div class="product-details">
                                    <h6>addidas New Hammer sole for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <div class="product-image">
                                    <img class="img-fluid" src="{{asset('images/product/p6.jpg')}}" alt="">
                                    <div class="prd-bottom">
                                        <a href="#" class="btn btn-action">
                                            Thêm
                                        </a>
                                        <a href="#" class="btn btn-action">
                                            Tym
                                        </a>
                                    </div>
                                </div>
                                <div class="product-details">
                                    <h6>addidas New Hammer sole for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <div class="product-image">
                                    <img class="img-fluid" src="{{asset('images/product/p6.jpg')}}" alt="">
                                    <div class="prd-bottom">
                                        <a href="#" class="btn btn-action">
                                            Thêm
                                        </a>
                                        <a href="#" class="btn btn-action">
                                            Tym
                                        </a>
                                    </div>
                                </div>
                                <div class="product-details">
                                    <h6>addidas New Hammer sole for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                <div class="product-image">
                                    <img class="img-fluid" src="{{asset('images/product/p6.jpg')}}" alt="">
                                    <div class="prd-bottom">
                                        <a href="#" class="btn btn-action">
                                            Thêm
                                        </a>
                                        <a href="#" class="btn btn-action">
                                            Tym
                                        </a>
                                    </div>
                                </div>
                                <div class="product-details">
                                    <h6>addidas New Hammer sole for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Best Seller -->
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting mr-auto">
                        <select>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                            <option value="1">Show 12</option>
                        </select>
                    </div>
                    <div class="pagination">
                        <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        <a href="#">6</a>
                        <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <!-- End Filter Bar -->
            </div>
        </div>
    </div>

    <!-- Start related-product Area -->
    <section class="related-product-area section_gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Deals of the Week</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="img/r1.jpg" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="img/r2.jpg" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="img/r3.jpg" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="img/r5.jpg" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="img/r6.jpg" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="img/r7.jpg" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="img/r9.jpg" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="img/r10.jpg" alt=""></a>
                                <div class="desc">
                                    <a href="#" class="title">Black lace Heels</a>
                                    <div class="price">
                                        <h6>$189.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="single-related-product d-flex">
                                <a href="#"><img src="img/r11.jpg" alt=""></a>
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
                            <img class="img-fluid d-block mx-auto" src="img/category/c5.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End related-product Area -->

    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
                            magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p>Stay update with our latest</p>
                        <div class="" id="mc_embed_signup">

                            <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">

                                <div class="d-flex flex-row">

                                    <input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">


                                    <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                    <div style="position: absolute; left: -5000px;">
                                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                    </div>

                                    <!-- <div class="col-lg-4 col-md-4">
													<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
												</div>  -->
                                </div>
                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget mail-chimp">
                        <h6 class="mb-20">Instragram Feed</h6>
                        <ul class="instafeed d-flex flex-wrap">
                            <li><img src="{{ asset('images/i1.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('images/i2.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('images/i3.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('images/i4.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('images/i5.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('images/i6.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('images/i7.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('images/i8.jpg') }}" alt=""></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <p>Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

    <!-- Modal Quick Product View -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="container relative">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="product-quick-view">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="quick-view-carousel">
                                <div class="item" style="background: url(img/organic-food/q1.jpg);">

                                </div>
                                <div class="item" style="background: url(img/organic-food/q1.jpg);">

                                </div>
                                <div class="item" style="background: url(img/organic-food/q1.jpg);">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="quick-view-content">
                                <div class="top">
                                    <h3 class="head">Mill Oil 1000W Heater, White</h3>
                                    <div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
                                    <div class="category">Category: <span>Household</span></div>
                                    <div class="available">Availibility: <span>In Stock</span></div>
                                </div>
                                <div class="middle">
                                    <p class="content">Mill Oil is an innovative oil filled radiator with the most modern technology. If you are
                                        looking for something that can make your interior look awesome, and at the same time give you the pleasant
                                        warm feeling during the winter.</p>
                                    <a href="#" class="view-full">View full Details <span class="lnr lnr-arrow-right"></span></a>
                                </div>
                                <div class="bottom">
                                    <div class="color-picker d-flex align-items-center">Color:
                                        <span class="single-pick"></span>
                                        <span class="single-pick"></span>
                                        <span class="single-pick"></span>
                                        <span class="single-pick"></span>
                                        <span class="single-pick"></span>
                                    </div>
                                    <div class="quantity-container d-flex align-items-center mt-15">
                                        Quantity:
                                        <input type="text" class="quantity-amount ml-15" value="1" />
                                        <div class="arrow-btn d-inline-flex flex-column">
                                            <button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
                                            <button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
                                        </div>

                                    </div>
                                    <div class="d-flex mt-20">
                                        <a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
                                        <a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
                                        <a href="#" class="like-btn"><span class="lnr lnr-heart"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/countdown.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=API_KEY"></script>
    <script src="{{ asset('js/gmaps.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>