<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from htmldemo.net/boyka/boyka/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Jun 2024 14:54:35 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo-shoes.png') }}">

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
    <style>
        .header-bottom-area {
            background: #fff;
            border-bottom: 1px solid #ddd;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-menu-area {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            padding-top: 10px
        }

        .main-navigation ul {
            display: flex;
            gap: 15px;
        }

        .header-bottom-right {
            display: flex;
            gap: 15px;
        }

        .trigger-search,
        .shoping-cart {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .logo{
            padding-left:20px;
        }
        .main-navigation ul li a {
            font-size: 16px;
        }

        .block-search .trigger-search span {
            font-size: 16px;
        }

        .shoping-cart .dropdown-toggle {
            font-size: 16px;
        }
        .main-menu-area .mega-menu > li a {
            font-size: 14px;
            font-weight: normal;
            text-transform: capitalize;
        }
    </style>

</head>

<body class="box-body  ">
    <div class="main-wrapper home-2">
    <!-- Main Wrapper Start -->
    <div class="main-wrapper">


        @include('client.layouts.header')

        <!-- Main Content -->
        <div class="content" style="min-height: calc(100vh - 200px); padding-top: 50px; padding-bottom: 50px; background:#fff; ">
            @yield('content')
        </div>
        <!-- End Main Content -->
        @include('client.layouts.footer')



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
            <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
            <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
            <!-- Popper JS -->
            <script src="{{ asset('assets/js/popper.min.js') }}"></script>
            <!-- Bootstrap JS -->
            <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
            <!-- Plugins JS -->
            <script src="{{ asset('assets/js/plugins.js') }}"></script>
            <!-- Plugins JS -->
            <script src="{{ asset('assets/js/plugins copy.js') }}"></script>
            <!-- Ajax Mail -->
            <script src="{{ asset('assets/js/ajax-mail.js') }}"></script>
            <!-- Main JS -->
            <script src="{{ asset('assets/js/main.js') }}"></script>
            <!-- Modernizr JS -->
            <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>

            <script>
                CKEDITOR.replace('ckeditor-classic');
            </script>
            <script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
            <script src="assets/libs/dropzone/dropzone-min.js"></script>
            <script src="assets/js/pages/project-create.init.js"></script>
            <script src="assets/js/app.js"></script>
            @yield('scripts')
</body>

</html>
