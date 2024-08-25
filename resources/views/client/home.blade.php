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

        /* test */

        .login-container {
            background: #8a8f6a4a;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 40px auto;
        }

        .login-container .btn-primary,
        .login-container .btn-default {
            background: linear-gradient(to right, #000000);
            border: none;
            border-radius: 10px;
            color: white;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        .login-container .btn-primary:hover,
        .login-container .btn-default:hover {
            background: linear-gradient(to right, #444444);
            color: white;
        }

        .login-container .form-control {
            border-radius: 10px;
            border: 1px solid white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-check-label {
            color: black;
        }

        a {
            text-decoration: none;
        }


        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
            display: flex;
            align-items: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.5s ease, transform 0.5s ease;
            transform: translateY(-20px);
        }

        .alert-show {
            opacity: 1;
            transform: translateY(0);
        }

        .alert-success {
            background-color: #28a745;
            color: white;
        }

        .alert-danger {
            background-color: #dc3545;
            color: white;
        }

        .alert .icon {
            margin-right: 10px;
        }

        .alert .icon-success {
            content: "\2714";
            /* Checkmark icon */
            font-size: 20px;
        }

        .alert .icon-danger {
            content: "\26A0";
            /* Warning icon */
            font-size: 20px;
        }

        /* test */
    </style>
    <style>
        .modal {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Màu nền mờ */
            z-index: 1000;
        }

        /* Modal content */
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 1000px;
            position: relative;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
            /* Thêm cuộn dọc nếu nội dung quá dài */
            max-height: 90vh;
            /* Giới hạn chiều cao của modal */
        }

        /* Close button */
        .close-button {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: #aaa;
        }

        .close-button:hover {
            color: black;
        }

        /* Table styles */
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .order-table th,
        .order-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }

        .order-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .order-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Adjusting table layout on smaller screens */
        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
                padding: 15px;
            }

            .order-table th,
            .order-table td {
                padding: 10px;
            }
        }

        .search-container {
            position: relative;
            text-align: center;
            margin: 20px 0;
        }

        #search-toggle-button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .search-fields {
            margin-top: 20px;
        }

        .search-field {
            margin-bottom: 15px;
        }

        .search-field label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .search-field input {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
    <style>
        .close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            float: right;
            margin-right: 10px;
        }
    </style>

    <style>
        .search-container {
            position: relative;
            width: 500px;
            margin: 0 auto;
            z-index: 1000;
            /* Đảm bảo container tìm kiếm nằm trên các phần tử khác */
        }

        .search-input {
            width: 100%;
            height: 50px;
            font-size: 18px;
            padding: 10px;
            border-radius: 10px;
            /* Bo tròn góc của thanh tìm kiếm */
            border: 1px solid #ccc;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Thêm shadow để tạo hiệu ứng nổi bật */
        }

        .suggestions-box {
            position: absolute;
            top: 60px;
            width: 100%;
            border: 1px solid #ccc;
            background-color: #fff;
            max-height: 300px;
            overflow-y: auto;
            display: none;
            /* Ẩn khi chưa có gợi ý */
            z-index: 1100;
            /* Đảm bảo danh sách gợi ý nằm trên cả banner */
            margin-top: 10px;
            /* Thêm khoảng cách giữa thanh tìm kiếm và danh sách gợi ý */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Thêm shadow để tạo hiệu ứng nổi bật */
            border-radius: 10px;
            /* Bo tròn góc của hộp gợi ý */
        }

        .suggestion-item {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            /* Bo tròn nhẹ góc của mỗi mục trong danh sách gợi ý */
        }

        .suggestion-item:hover {
            background-color: #f0f0f0;
        }

        .suggestion-image {
            width: 50px;
            height: 50px;
            margin-right: 20px;
            /* Tăng khoảng cách giữa hình ảnh và chữ */
            border-radius: 5px;
            object-fit: cover;
        }

        .suggestion-item span {
            font-size: 16px;
            flex-grow: 1;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-show" id="alert">
            <span class="icon icon-success"></span>
            {{ session('success') }}
            <button type="button" class="close" onclick="closeAlert()">&times;</button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-show" id="alert">
            <span class="icon icon-danger"></span>
            {{ session('error') }}
        </div>
    @endif

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
                                    <img class="img-fluid" src="{{ $product->img_thumbnail}}"
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

                                    <button class="add-to-cart" title="Add to cart"><i class="fa fa-plus"></i> Thêm vào
                                        giỏ hàng</button>

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

    <script>
        function searchProducts(query) {
            const suggestionsBox = document.getElementById('suggestions');

            if (query.length === 0) {
                suggestionsBox.style.display = 'none';
                return;
            }

            fetch(`/search?search=${query}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        suggestionsBox.innerHTML = data.map(product => `
                    <div class="suggestion-item" onclick="selectSuggestion(${product.id})">
                        <img class="img-fluid suggestion-image" src="/storage/${product.img_thumbnail}" style="width: 50px; height: 50px; object-fit: cover;" alt="${product.name}">
                        <span>${product.name}</span>
                    </div>
                `).join('');
                        suggestionsBox.style.display = 'block';
                    } else {
                        suggestionsBox.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                });
        }

        function selectSuggestion(productId) {
            window.location.href = `/product/${productId}`;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var searchToggleButton = document.getElementById('search-toggle-button');
            var searchFields = document.getElementById('search-fields');

            searchToggleButton.addEventListener('click', function() {
                if (searchFields.style.display === "none" || searchFields.style.display === "") {
                    searchFields.style.display = "block";
                } else {
                    searchFields.style.display = "none";
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('order-search-result');
            var closeButton = document.querySelector('.close-button');

            closeButton.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            // Mở modal khi có kết quả tìm kiếm
            if (modal) {
                modal.style.display = 'flex';
            }
        });

        window.onload = function() {
            var alert = document.getElementById('alert');
            if (alert) {
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 3000);
            }
        };

        // Hàm ẩn thông báo ngay lập tức khi nhấn nút "Close"
        function closeAlert() {
            var alert = document.getElementById('alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }

        function closeModal() {
            document.getElementById("order-details-modal").style.display = "none";
        }
    </script>
    <script>
        // test
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('alert');
            if (alert) {
                setTimeout(() => {
                    alert.classList.remove('alert-show');
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 500); // Thời gian cho hiệu ứng ẩn
                }, 3000); // Thông báo sẽ ẩn sau 3 giây
            }
        });


        // test

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
