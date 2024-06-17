<!DOCTYPE html>
<html lang="zxx" class="no-js">

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
    <title>Food Forward</title>
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
    <style>
        .banner-area {
            position: relative;
            width: 100%;
            height: 100vh;
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

/* New styles added */
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
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
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

    <body>
</head>

<body>

    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{route('users.home')}}"><img src="{{asset('images/logo_ff.png  ')}}" alt=""></a>
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
                            <li class="nav-item active"><a class="nav-link" href="{{route('users.home')}}">Home</a></li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Shop</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="">Shop Category</a></li>
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
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/tracking') }}">Tracking</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/elements') }}">Elements</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
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
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->
    <div class="content">
        @yield('content')
    </div>





    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                            ut labore dolore
                            magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  col-md-6 col-sm-6">
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
                <p class="footer-text m-0">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

    <<script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
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
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <script src="{{ asset('js/gmaps.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


    @yield('script')
</body>

</html>
