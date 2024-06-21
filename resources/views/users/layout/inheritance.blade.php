<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('img/fav.png') }}">
    <meta name="author" content="CodePixar">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Food Forward</title>
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

    @yield('style-list')
    <style>
        .login {
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
            background: none !important;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        @media (max-width: 768px) {
            .custom-control-label {
                font-size: 14px;
            }
        }

        .product_image_area {
            margin-top:20px;
        }
        .s_Product_carousel {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .single-prd-item {
            flex: 0 0 20%; /* Adjust width as needed */
            margin-right: 10px;
            margin-bottom: 10px;
            padding:3px;
        }
        .single-prd-item:hover {
            background: green;
        }
        .single-prd-item img {
            width: 100%;
            height: auto;
            display: block;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .s_product_text {
            margin-top: 20px;
        }
        .list {
            list-style: none;
            padding: 0;
        }
        .list li {
            margin-bottom: 10px;
        }
        .d-flex {
            display: flex;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: .5rem;
        }
        .form-control {
            text-align: center;
            display: block;
            line-height: 1.5;
            font-weight: bold;
            color: #07b52d;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .card_area .primary-btn{
                height:50px;
                border:none;

        }
        .card_area{
            padding-left: 120px;
        }
        .primary-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            width:200px;
            vertical-align: middle;
            transition: background-color 0.3s ease;
        }
        .primary-btn:hover {
          background-color: #0056b3;
        }
        .icon_btn {
            margin-left: 10px;
            color: #333;
        }
        .icon_btn i {
            font-size: 20px;
        }
        .card_area {
            margin-top: 20px;
        }
        .product_detail_row {
            display: flex;
            height:70px;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px; /* Khoảng cách dưới cùng */
            background-color: orange;
            transition: background-color 0.3s ease;
            opacity: 85%;
        }
        .product_detail_title {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin: 0;
        }

    </style>
</head>

<body>
    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ route('index') }}"><img
                            src="{{ asset('images/logo_ff.png') }}" alt="logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Shop</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="#">Shop Category</a></li>
                                    <li class="nav-item"><a class="nav-link" href="single-product.html">Product
                                            Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="checkout.html">Product Checkout</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="cart.html">Shopping Cart</a></li>
                                    <li class="nav-item"><a class="nav-link" href="confirmation.html">Confirmation</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/tracking') }}">Tracking</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/elements') }}">Elements</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">

                            <li class="nav-item"><a href="{{route('users.cart.list')}}" class="cart"><img
                                        src="{{ asset('images/Imagecut/Giohang.png') }}" width="30px"
                                        alt=""></a></li>
                            <li class="nav-item"><button class="search"><img
                                        src="{{ asset('images/Imagecut/Timkiem.png') }}" width="30px"
                                        style="align-items: center" alt=""></button>
                                        </li>
                            <li class="nav-item dropdown">
                                @auth
                                    <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('images/icon_user.png') }}" width="10px"
                                            alt="profile-icon"> {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="#">Profile</a>
                                        <a class="dropdown-item" href="#">Wishlist</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            Logout
                                        </a>

                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="nav-link"><i class="fa fa-user"></i> Đăng
                                        nhập</a>
                                @endauth
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
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    <!-- Main Content -->
    <div class="content" style="min-height: calc(100vh - 200px); padding-top: 50px; padding-bottom: 50px;">
        @yield('content')
    </div>
    <!-- End Main Content -->

    <!-- Footer -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p>Stay update with our latest</p>
                        <div class="" id="mc_embed_signup">
                            <form target="_blank" novalidate="true"
                                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                method="get" class="form-inline">
                                <div class="d-flex flex-row">
                                    <input class="form-control" name="EMAIL" placeholder="Enter Email"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                                        required="" type="email">
                                    <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right"
                                            aria-hidden="true"></i></button>
                                    <div style="position: absolute; left: -5000px;">
                                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1"
                                            value="" type="text">
                                    </div>
                                </div>
                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
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
                <p class="footer-text m-0">
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                </p>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Scripts -->
    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/jsAdmin/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/countdown.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>
