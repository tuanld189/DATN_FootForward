<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from htmldemo.net/boyka/boyka/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Jun 2024 14:54:35 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>FootForward</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSS -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Font CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- Customr Style CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @yield('styles')

    <!-- Modernizr JS -->
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    @yield('styles')
</head>

<body class="box-body">

    <!-- Main Wrapper Start -->
    <div class="main-wrapper home-2">

        <div class="container-box">
            <!-- header-area start -->
            <div class="header-area">
                <!-- header-top start -->
                <div class="header-top bg-grey">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 order-lg-1 col-md-5 order-1">
                                <div class="top-selector-wrapper">
                                    <ul class="single-top-selector-left">
                                        <!-- Currency Start -->
                                        <li class="currency list-inline-item">
                                            <div class="btn-group">
                                                <button class="dropdown-toggle"> USD $ <i
                                                        class="fa fa-angle-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a href="#">Euro €</a></li>
                                                        <li><a href="#" class="current">USD $</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Currency End -->
                                        <!-- Language Start -->
                                        <li class="language list-inline-item">
                                            <div class="btn-group">
                                                <button class="dropdown-toggle"><img
                                                        src="{{ asset('assets/images/icon/la-1.jpg') }}" alt="">
                                                    English <i class="fa fa-angle-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a href="#"><img
                                                                    src="{{ asset('assets/images/icon/la-1.jpg') }}"
                                                                    alt=""> English</a></li>
                                                        <li><a href="#"><img
                                                                    src="{{ asset('assets/images/icon/la-2.jpg') }}"
                                                                    alt=""> Français</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Language End -->
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 order-lg-2 col-md-12">
                                <!-- logo start -->
                                <div class="logo text-center">
                                    <a href="index.html"><img src="{{ asset('assets/images/logo-dark.png') }}"
                                            alt=""></a>
                                </div>
                                <!-- logo end -->
                            </div>
                            <div class="col-lg-4 order-lg-3 col-lg-4 col-md-7 order-2">
                                <div class="header-bottom-right">
                                    <ul class="single-setting-selector">
                                        <!-- Sanguage Start -->
                                        <li class="setting-top list-inline-item">
                                            <div class="btn-group">
                                                <button class="dropdown-toggle"><i class="fa fa-user-circle-o"></i>
                                                    Setting <i class="fa fa-angle-down"></i></button>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a href="my-account.html">My account</a></li>
                                                        <li><a href="checkout.html">Checkout</a></li>
                                                        <li><a href="login-register.html">Sign in</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Sanguage End -->
                                    </ul>
                                    <!-- block-search start -->
                                    <div class="block-search">
                                        <div class="trigger-search"><i class="fa fa-search"></i> <span>Search</span>
                                        </div>
                                        <!-- search-box start -->
                                        <div class="search-box main-search-active">
                                            <form action="#" class="search-box-inner">
                                                <input type="text" placeholder="Search our catalog">
                                                <button class="search-btn" type="submit"><i
                                                        class="fa fa-search"></i></button>
                                            </form>
                                        </div>
                                        <!-- search-box end -->
                                    </div>
                                    <!-- block-search end -->
                                    <div class="shoping-cart">
                                        <div class="btn-group">
                                            <!-- Mini Cart Button start -->
                                            <button class="dropdown-toggle"><i class="fa fa-shopping-cart"></i>
                                                Cart</button>
                                            <!-- Mini Cart button end -->

                                            <!-- Mini Cart wrap start -->
                                            <div class="dropdown-menu mini-cart-wrap">
                                                <div class="shopping-cart-content">
                                                    <ul class="mini-cart-content">

                                                        <!-- Mini-Cart-item start -->
                                                        <li class="mini-cart-item">
                                                            <div class="mini-cart-product-img">
                                                                <a href="#"><img src="assets/images/cart/3.jpg"
                                                                        alt=""></a>
                                                                <span class="product-quantity">1x</span>
                                                            </div>
                                                            <div class="mini-cart-product-desc">
                                                                <h3><a href="#">Faded Sleeves T-shirt</a></h3>
                                                                <div class="price-box">
                                                                    <span class="new-price">$72.21</span>
                                                                </div>
                                                                <div class="size">
                                                                    Size: M
                                                                </div>
                                                            </div>
                                                            <div class="remove-from-cart">
                                                                <a href="#" title="Remove"><i
                                                                        class="fa fa-trash"></i></a>
                                                            </div>
                                                        </li>
                                                        <!-- Mini-Cart-item end -->

                                                        <li>
                                                            <!-- shopping-cart-total start -->
                                                            <div class="shopping-cart-total">
                                                                <h4>Sub-Total : <span>$127.42</span></h4>
                                                                <h4>Total : <span>$127.42</span></h4>
                                                            </div>
                                                            <!-- shopping-cart-total end -->
                                                        </li>

                                                        <li>
                                                            <!-- shopping-cart-btn start -->
                                                            <div class="shopping-cart-btn">
                                                                <a href="checkout.html">Checkout</a>
                                                            </div>
                                                            <!-- shopping-cart-btn end -->
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- Mini Cart wrap End -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header-top end -->
                <!-- Header-bottom start -->
                <div class="header-bottom-area bg-grey header-sticky">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 d-none d-lg-block">
                                <!-- main-menu-area start -->
                                <div class="main-menu-area text-center">
                                    <nav class="main-navigation">
                                        <ul>
                                            <li class="active"><a href="{{route('index')}}">Home </a>
                                                {{-- <ul class="sub-menu">
                                            <li><a href="index.html">Home Page 1</a></li>
                                            <li><a href="index-2.html">Home Page 2</a></li>
                                            <li><a href="index-3.html">Home Page 3</a></li>
                                            <li><a href="index-4.html">Home Page 4</a></li>
                                            <li><a href="index-5.html">Home Page 5</a></li>
                                            <li><a href="index-6.html">Home Page 6</a></li>
                                            <li><a href="index-7.html">Home Page 7</a></li>
                                            <li><a href="index-8.html">Home Page 8</a></li>
                                        </ul> --}}
                                            </li>
                                            <li><a href="shop.html">Shop <i class="fa fa-angle-down"></i></a>
                                                <ul class="mega-menu">
                                                    <li><a href="#">Shop PageLayout</a>
                                                        <ul>

                                                            <li><a href="shop-3-col.html">Shop 3 Column</a></li>
                                                            <li><a href="shop-4-col.html">Shop 4 Column</a></li>
                                                            <li><a href="shop.html">Shop Left Sidebar</a></li>
                                                            <li><a href="shop-right-sidebar.html">Shop Right
                                                                    Sidebar</a></li>
                                                            <li><a href="shop-list-left-sidebar.html">Shop List Left
                                                                    Sidebar</a></li>
                                                            <li><a href="shop-list-right-sidebar.html">Shop List Right
                                                                    Sidebar</a></li>
                                                            <li><a href="shop-list-fullwidth.html">Shop Lsiting
                                                                    View</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="blog.html">Products Details Style</a>
                                                        <ul>
                                                            <li><a href="product-details-vertical.html">Single Product
                                                                    Tab Left</a></li>
                                                            <li><a href="product-details-vertical-right.html">Single
                                                                    Product Tab Right</a></li>
                                                            <li><a href="product-details-carousel.html">Single Product
                                                                    Carousel</a></li>
                                                            <li><a href="product-details-gallery.html">Single Product
                                                                    Gallery Left</a></li>
                                                            <li><a href="product-details-gallery-right.html">Single
                                                                    Product Gallery Right</a></li>
                                                            <li><a href="product-details-sticky.html">Single Product
                                                                    Sticky Left</a></li>
                                                            <li><a href="product-details-sticky-right.html">Single
                                                                    Product Sticky Right</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Single Products</a>
                                                        <ul>
                                                            <li><a href="product-details.html">Single Product</a></li>
                                                            <li><a href="product-details-group.html">Single Product
                                                                    Group</a></li>
                                                            <li><a href="product-details-normal.html">Single Product
                                                                    Normal</a></li>
                                                            <li><a href="product-details-affiliate.html">Single Product
                                                                    Affiliate</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="shop.html">Page <i class="fa fa-angle-down"></i></a>
                                                <ul class="mega-menu four-column-menu">
                                                    <li><a href="#">Column One</a>
                                                        <ul>
                                                            <li><a href="compare.html">Compare Page</a></li>
                                                            <li><a href="login-register.html">Login &amp; Register</a>
                                                            </li>
                                                            <li><a href="my-account.html">My Account Page</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="blog.html">Column two</a>
                                                        <ul>
                                                            <li><a href="cart.html">Cart Page</a></li>
                                                            <li><a href="checkout.html">Checkout Page</a></li>
                                                            <li><a href="wishlist.html">Wishlist Page</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Column Three</a>
                                                        <ul>
                                                            <li><a href="blog-details-video.html">Blog Details
                                                                    video</a></li>
                                                            <li><a href="blog-details-audio.html">Blog Details
                                                                    Audio</a></li>
                                                            <li><a href="blog-details-slider.html">Blog Details
                                                                    Slider</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Column Four</a>
                                                        <ul>
                                                            <li><a href="error404.html">Error 404</a></li>
                                                            <li><a href="faq.html">FAQ</a></li>
                                                            <li><a href="coming-soon.html">Coming Soon</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="blog.html">Blog</i></a>
                                                {{-- <ul class="sub-menu">
                                            <li><a href="blog-col-2.html">Blog Grid 2 Layout</a></li>
                                            <li><a href="blog-col-3.html">Blog Grid 3 Layout</a></li>
                                            <li><a href="blog.html">Blog Left Sidebar</a></li>
                                            <li><a href="blog-details-right-sidebar.html">Blog Right Sidebar</a></li>
                                            <li><a href="blog-details-slider.html">Blog Details Left Slider</a></li>
                                            <li><a href="blog-details-right-sidebar.html">Blog Details Right Slider</a></li>
                                        </ul> --}}
                                            </li>
                                            <li><a href="about.html">About</a></li>
                                            <li><a href="contact-us.html">Contact us</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- main-menu-area start -->
                            </div>
                            <div class="col">
                                <!-- mobile-menu start -->
                                <div class="mobile-menu d-block d-lg-none"></div>
                                <!-- mobile-menu end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header-bottom end -->
            </div>
            <!-- Header-area end -->

            <!-- Main Content -->
            <div class="content" style="min-height: calc(100vh - 200px); padding-top: 50px; padding-bottom: 50px;">
                @yield('content')
            </div>
            <!-- End Main Content -->

            <!-- Footer Aare Start -->
            <footer class="footer-area">
                <!-- footer-top start -->
                <div class="footer-top pt--100 section-pb">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <!-- footer-info-area start -->
                                <div class="footer-info-area">
                                    <div class="footer-logo">
                                        <a href="#"><img src="assets/images/logo/logo_footer.png"
                                                alt=""></a>
                                    </div>
                                    <div class="desc_footer">
                                        <p><i class="fa fa-home"></i> <span> 123 Main Street, Anytown, CA 12345 -
                                                USA.</span> </p>
                                        <p><i class="fa fa-phone"></i> <span> (0) 800 456 789</span> </p>
                                        <p><i class="fa fa-envelope-open-o"></i> <span> contact@demoemail.com</span>
                                        </p>
                                        <div class="link-follow-footer">
                                            <ul class="footer-social-share">
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- footer-info-area end -->
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <!-- footer-info-area start -->
                                        <div class="footer-info-area">
                                            <div class="footer-title">
                                                <h3>Products</h3>
                                            </div>
                                            <div class="desc_footer">
                                                <ul>
                                                    <li><a href="#">Prices drop</a></li>
                                                    <li><a href="#"> New products</a></li>
                                                    <li><a href="#"> Best sales</a></li>
                                                    <li><a href="#"> Contact us</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- footer-info-area end -->
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <!-- footer-info-area start -->
                                        <div class="footer-info-area">
                                            <div class="footer-title">
                                                <h3>Our company</h3>
                                            </div>
                                            <div class="desc_footer">
                                                <ul>
                                                    <li><a href="#">Delivery</a></li>
                                                    <li><a href="#">About us</a></li>
                                                    <li><a href="#">Contact us</a></li>
                                                    <li><a href="#">Sitemap</a></li>
                                                    <li><a href="#">Stores</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- footer-info-area end -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <!-- footer-info-area start -->
                                <div class="footer-info-area">
                                    <div class="footer-title">
                                        <h3>Join Our Newsletter Now </h3>
                                    </div>
                                    <div class="desc_footer">
                                        <div class="input-newsletter">
                                            <input name="email" class="input_text" value=""
                                                placeholder="Your email address" type="text">
                                            <button class="btn-newsletter"><i
                                                    class="fa fa-paper-plane-o"></i></button>
                                        </div>
                                        <p>Get E-mail updates about our latest shop and special offers.</p>
                                    </div>
                                </div>
                                <!-- footer-info-area end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer-top end -->
                <!-- footer-buttom start -->
                <div class="footer-buttom">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-7">
                                <div class="copy-right">
                                    <p>Copyright 2021 <a href="#">Boyka</a>. All Rights Reserved</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-5">
                                <div class="payment">
                                    <img src="assets/images/icon/1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer-buttom start -->
            </footer>
            <!-- Footer Aare End -->

            <!-- Modal Algemeen Uitgelicht start -->
            <div class="modal fade modal-wrapper" id="exampleModalCenter">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-inner-area row">
                                <div class="col-lg-5 col-md-6 col-sm-6">
                                    <!-- Product Details Left -->
                                    <div class="product-details-left">
                                        <div class="product-details-images slider-navigation-1">
                                            <div class="lg-image">
                                                <img src="assets/images/product/1.jpg" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img src="assets/images/product/2.jpg" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img src="assets/images/product/3.jpg" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img src="assets/images/product/5.jpg" alt="product image">
                                            </div>
                                        </div>
                                        <div class="product-details-thumbs slider-thumbs-1">
                                            <div class="sm-image"><img src="assets/images/product/1.jpg"
                                                    alt="product image thumb"></div>
                                            <div class="sm-image"><img src="assets/images/product/2.jpg"
                                                    alt="product image thumb"></div>
                                            <div class="sm-image"><img src="assets/images/product/3.jpg"
                                                    alt="product image thumb"></div>
                                            <div class="sm-image"><img src="assets/images/product/4.jpg"
                                                    alt="product image thumb"></div>
                                        </div>
                                    </div>
                                    <!--// Product Details Left -->
                                </div>

                                <div class="col-lg-7 col-md-6 col-sm-6">
                                    <div class="product-details-view-content">
                                        <div class="product-info">
                                            <h2>Healthy Melt</h2>
                                            <div class="price-box">
                                                <span class="old-price">$70.00</span>
                                                <span class="new-price">$76.00</span>
                                                <span class="discount discount-percentage">Save 5%</span>
                                            </div>
                                            <p>100% cotton double printed dress. Black and white striped top and orange
                                                high waisted skater skirt bottom. Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit. quibusdam corporis, earum facilis et
                                                nostrum dolorum accusamus similique eveniet quia pariatur.</p>
                                            <div class="product-variants">
                                                <div class="produt-variants-size">
                                                    <label>Size</label>
                                                    <select class="form-control-select">
                                                        <option value="1" title="S" selected="selected">S
                                                        </option>
                                                        <option value="2" title="M">M</option>
                                                        <option value="3" title="L">L</option>
                                                    </select>
                                                </div>
                                                <div class="produt-variants-color">
                                                    <label>Color</label>
                                                    <ul class="color-list">
                                                        <li><a href="#" class="orange-color active"></a></li>
                                                        <li><a href="#" class="paste-color"></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="single-add-to-cart">
                                                <form action="#" class="cart-quantity">
                                                    <div class="quantity">
                                                        <label>Quantity</label>
                                                        <div class="cart-plus-minus">
                                                            <input class="cart-plus-minus-box" value="1"
                                                                type="text">
                                                            <div class="dec qtybutton"><i
                                                                    class="fa fa-angle-down"></i></div>
                                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="add-to-cart" type="submit">Add to cart</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Algemeen Uitgelicht end -->

            <!-- jQuery JS -->
            <script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
            <script src="{{asset('assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
            <!-- Popper JS -->
            <script src="{{asset('assets/js/popper.min.js')}}"></script>
            <!-- Bootstrap JS -->
            <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
            <!-- Plugins JS -->
            <script src="{{asset('assets/js/plugins.js')}}"></script>
            <!-- Plugins JS -->
            <script src="{{asset('assets/js/plugins copy.js')}}"></script>
            <!-- Ajax Mail -->
            <script src="{{asset('assets/js/ajax-mail.js')}}"></script>
            <!-- Main JS -->
            <script src="{{asset('assets/js/main.js')}}"></script>
            @yield('scripts')
</body>

</html>
