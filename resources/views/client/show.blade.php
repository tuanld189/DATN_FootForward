@extends('client.layouts.master')
@section('title', 'Chi tiết sản phẩm')
@section('styles')
    <style>
        .card_area .add-to-cart {
            color: white;
            background-color: #8a8f6a;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 10px;
        }

        /* CSS for hover effect */
        .card_area .add-to-cart:hover {
            background-color: #8a8f6a;
        }

        .custom-control-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .custom-control-label img {
            margin-left: 8px;
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .custom-control-input:checked~.custom-control-label span {
            font-weight: bold;
        }

        .comment-form-area {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .comment-input {
            flex-grow: 1;
        }

        .comment-avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 8px 15px;
            border-radius: 0;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
            padding: 8px 15px;
            border-radius: 0;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .custom-control-input {
            display: none;
        }

        .custom-control-label {
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 6px 12px;
            margin: 2px;
            transition: all 0.3s ease;
        }

        .custom-control-label img {
            border-radius: 5px;
        }

        .custom-control-input:checked+.custom-control-label {
            border-color: #8a8f6a;
            background-color: #8a8f6a4a;
        }

        .custom-control-input:checked+.custom-control-label img {
            border: 2px solid #8a8f6a;
        }

        .price-box {
            position: relative;
            display: inline-block;
        }

        .old-price {
            text-decoration: line-through;
            color: #999;
            margin-right: 10px;
        }

        .discount {
            background-color: #e74c3c;
            color: #fff;
            padding: 3px 8px;
            border-radius: 3px;
            margin-left: 10px;
        }

        .product-details-thumbs {
            display: flex;
            justify-content: center;
            gap: 10px;
            /* Khoảng cách giữa các ảnh */
            margin-top: 10px;
            /* Khoảng cách từ các ảnh thumb đến ảnh lớn */
        }

        .product-details-thumbs img {

            object-fit: cover;
            /* Đảm bảo ảnh vừa với khung mà không bị biến dạng */
            cursor: pointer;
            border: 2px solid transparent;
            /* Viền mặc định */
            transition: border-color 0.3s;
        }

        .product-details-thumbs img:hover {
            border-color: #007bff;
            /* Viền khi hover */
        }


        .quantity-control {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #8a8f6a;
            border-radius: .25rem;
            overflow: hidden;
            width: 100px;
            margin: 0 auto;

        }
        .quantity-control button {
            border: none;
            background-color: #8a8f6a;
            color:white;
            font-size: 1rem;
            width: 2.5rem;
            height: 2.5rem;
        }
        .quantity-control input {
            border: none;
            width: 50px;
            text-align: center;
            outline: none;

        }
    </style>
@endsection

@section('content')
    <!-- breadcrumb-area start -->

    <!-- breadcrumb-area end -->


    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="border: 1px solid white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <h4 class="mb-sm-0">Chi tiết sản phẩm</h4>

                        <div class="page-title-right ">
                            <ol class="breadcrumb m-0 ">
                                <li class="m-1"><a href="{{ route('index') }}">Trang chủ > </a></li>
                                <li class="active m-1" href="{{ route('shop') }}"> Sản phẩm > </li>
                                <li class="active m-1"> Chi tiết sản phẩm </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Hiển thị thông báo lỗi -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            {{-- <div class="breadcrumb-area bg-grey mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="breadcrumb-list">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Product Details</li>
                        </ul>
                    </div>
                </div>
        </div> --}}
            <div class="row single-product-area" >
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-details-left">

                        <div class="product-details-images slider-lg-image-1 m-2" style="width: 100%">
                            @foreach ($product->galleries as $gallery)
                                <div class="lg-image">
                                    <a href="{{ asset('storage/' . $gallery->image) }}" class="img-poppu">
                                        <img class="img-fluid " src="{{ asset('storage/' . $gallery->image) }}"
                                            alt="product image"
                                            style="border:1px  solid rgb(196, 194, 194); border-radius:5px; ">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        {{-- <hr> --}}
                        <div class="product-details-thumbs slider-thumbs-1">
                            @foreach ($product->galleries as $gallery)
                                <img class="img-fluid m-1" style="border:1px  solid rgb(196, 194, 194); border-radius:5px; "
                                    src="{{ asset('storage/' . $gallery->image) }}" alt="product image">
                            @endforeach
                        </div>

                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content">
                        <div class="product-info">
                            <h2>{{ $product->name }}</h2>
                            <div class="price-box">
                                @if ($product->sales->isNotEmpty() && $product->sales->first()->pivot && $product->sales->first()->status)
                                    <span class="old-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                    <span
                                        class="new-price">{{ number_format($product->sales->first()->pivot->sale_price, 0, ',', '.') }}
                                        VNĐ</span>
                                    @php
                                        $discountPercentage =
                                            (($product->price - $product->sales->first()->pivot->sale_price) /
                                                $product->price) *
                                            100;
                                    @endphp
                                    <span class="discount discount-percentage">Save
                                        {{ round($discountPercentage, 0) }}%</span>
                                @else
                                    <span class="new-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                @endif
                            </div>


                            <div class="col-md-12">


                                <form id="variantForm" action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <div class="form-group">
                                        <label for="size">Kích cỡ:</label>
                                        <div class="d-flex flex-wrap">
                                            @php
                                                $displayedSizes = [];
                                            @endphp
                                            @foreach ($product->variants as $variant)
                                                @if (!in_array($variant->size->id, $displayedSizes))
                                                    @php
                                                        $displayedSizes[] = $variant->size->id;
                                                    @endphp
                                                    <div class="custom-control custom-radio mr-3 mb-2">
                                                        <input type="radio" id="size{{ $variant->size->id }}"
                                                            name="product_size_id" value="{{ $variant->size->id }}"
                                                            class="custom-control-input" onchange="updateQuantity()">
                                                        <label class="custom-control-label"
                                                            for="size{{ $variant->size->id }}">{{ $variant->size->name }}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="color">Màu:</label>
                                        <div class="d-flex flex-wrap">
                                            @php
                                                $displayedColors = []; // Array to track displayed colors
                                            @endphp
                                            @foreach ($product->variants as $variant)
                                                @if ($variant->image && !in_array($variant->color->id, $displayedColors))
                                                    @php
                                                        $displayedColors[] = $variant->color->id; // Mark color as displayed
                                                    @endphp
                                                    <div class="custom-control custom-radio mr-3 mb-2">
                                                        <input type="radio" id="color{{ $variant->color->id }}"
                                                            name="product_color_id" value="{{ $variant->color->id }}"
                                                            class="custom-control-input" onchange="updateQuantity()">
                                                        <label class="custom-control-label d-flex align-items-center"
                                                            for="color{{ $variant->color->id }}">
                                                            <img src="{{ asset('storage/' . $variant->image) }}"
                                                                alt="{{ $variant->color->name }}"
                                                                style="width: 40px; height: 40px; object-fit: cover; margin-right: 8px;">
                                                            <span>{{ $variant->color->name }}</span>
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="available_quantity">Available Quantity:</label>
                                        <input type="text" class="form-control" id="available_quantity"
                                            name="available_quantity" readonly  style="width:70px; display:flex; justify-between:center;">
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" class="form-control" id="quantity_add" name="quantity_add"
                                            min="1" value="1" style="width:70px;">
                                    </div> --}}


                                    <div class="abc mt-2">
                                        <div class="col-lg-3 col-sm-6"
                                            style="display: flex; justify-content: space-between;">
                                            <div class="p-2 border border-dashed rounded" style="margin-right: 20px;">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 text-center">
                                                        <p class="mb-1" style="color: black;"><b>Số lượng:</b></p>
                                                        <div class="quantity-control">
                                                            <button type="button" id="decrement" style="background-color: #8a8f6a;color:white;">-</button>
                                                            <input type="number" id="quantity_add" name="quantity_add" min="1" value="1">
                                                            <button type="button" id="increment" style="background-color: #8a8f6a;color:white;">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2 border border-dashed rounded">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <p class="mb-1" style="color: black;"><b>Hàng Có sẵn:</b></p>
                                                        <input type="text" class="form-control" id="available_quantity"
                                                            name="available_quantity" readonly
                                                            style="width: 100px; text-align: center; border: 1px solid #8a8f6a;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-2">{{ $product->content }}</p>
                                    <div class="card_area d-flex align-items-center">

                                        <button type="submit" class="add-to-cart">Thêm vào giỏ hàng</button>
                                    </div>
                                </form>
                            </div>

                            <div class="product-availability">
                                <i class="fa fa-check"></i> In stock
                            </div>
                            <div class="product-social-sharing">
                                <label>Chia sẻ</label>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                            <div class="block-reassurance">
                                <ul>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                            <p>Chính sách bảo mật (chỉnh sửa với mô -đun đảm bảo khách hàng)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-truck"></i>
                                            </div>
                                            <p>Chính sách giao hàng (chỉnh sửa với mô -đun đảm bảo của khách hàng)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-exchange"></i>
                                            </div>
                                            <p>Chính sách trả lại (Chỉnh sửa với Mô -đun trấn an khách hàng)</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-details-tab mt--60">
                        <ul role="tablist" class="mb--50 nav">
                            <li class="active" role="presentation">
                                <a data-bs-toggle="tab" role="tab" href="#description"
                                    class="active">Description</a>
                            </li>
                            <li role="presentation">
                                <a data-bs-toggle="tab" role="tab" href="#sheet">Thông tin chi tiết sản phẩm</a>
                            </li>
                            <li role="presentation">
                                <a data-bs-toggle="tab" role="tab" href="#reviews">Bình luận</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product_details_tab_content tab-content">
                        <!-- Start Single Content -->
                        <div class="product_tab_content tab-pane active" id="description" role="tabpanel">
                            <div class="product_description_wrap">
                                <div class="product_desc mb--30">
                                    <h2 class="title_3">Chi tiết</h2>
                                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit
                                    ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                    mollit anim id.</p> --}}
                                    <p class="mt-2">{!! $product->description !!}</p>

                                </div>
                                {{-- <div class="pro_feature">
                                    <h2 class="title_3">Features</h2>
                                    <ul class="feature_list">
                                        <li><a href="#"><i class="fa fa-play"></i>Duis aute irure dolor in
                                                reprehenderit in voluptate velit esse</a></li>
                                        <li><a href="#"><i class="fa fa-play"></i>Irure dolor in reprehenderit in
                                                voluptate velit esse</a></li>
                                        <li><a href="#"><i class="fa fa-play"></i>Sed do eiusmod tempor incididunt
ut labore et </a></li>
                                        <li><a href="#"><i class="fa fa-play"></i>Nisi ut aliquip ex ea commodo
                                                consequat.</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        <!-- End Single Content -->
                        <!-- Start Single Content -->
                        <div class="product_tab_content tab-pane" id="sheet" role="tabpanel">
                            <div class="pro_feature">
                                <h2 class="title_3">Chi tiết mua hàng:</h2>
                                <p class="mt-2">{!! $product->description !!}</p>
                                <h2 class="title_3">Data sheet</h2>
                                <ul class="feature_list">
                                    <li><a href="#"><i class="fa fa-play"></i>Duis aute irure dolor in reprehenderit
                                            in voluptate velit esse</a></li>
                                    <li><a href="#"><i class="fa fa-play"></i>Irure dolor in reprehenderit in
                                            voluptate velit esse</a></li>
                                    <li><a href="#"><i class="fa fa-play"></i>Irure dolor in reprehenderit in
                                            voluptate velit esse</a></li>
                                    <li><a href="#"><i class="fa fa-play"></i>Sed do eiusmod tempor incididunt ut
                                            labore et </a></li>
                                    <li><a href="#"><i class="fa fa-play"></i>Sed do eiusmod tempor incididunt ut
                                            labore et </a></li>
                                    <li><a href="#"><i class="fa fa-play"></i>Nisi ut aliquip ex ea commodo
                                            consequat.</a></li>
                                    <li><a href="#"><i class="fa fa-play"></i>Nisi ut aliquip ex ea commodo
                                            consequat.</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Content -->
                        <!-- Start Single COMMENT -->

                        <div class="product_tab_content tab-pane" id="reviews" role="tabpanel"
                        style="background-color: white;">
                            <div class="row" >
                                <!-- Column for posting comment -->
                                <div class="col-lg-6">
                                    <!-- Start Rating Area -->
                                    <div class="rating_wrap " style="margin-top: 20px; padding:20px;">
                                        <h2 class="rating-title ">Write A review</h2>
                                        <h4 class="rating-title-2">Your Rating</h4>
                                        <div class="rating_list">
                                            <ul class="product-rating d-flex">
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- End Rating Area -->

                                    <div class="comments-area comments-reply-area mt-3">
                                        <form action="{{ route('product.comment', $product->id) }}" method="POST"
                                            class="comment-form-area">
                                            @csrf
                                            <div class="form-group ">
                                                <div style="display: flex;">
                                                    <div class="review_thumb"
                                                        style="margin-right: 15px; margin-top:70px; margin-left:20px;">
                                                        <img alt="user avatar"
                                                            src="{{ Storage::url(Auth::check() ? Auth::user()->photo_thumbs : '') }}"
                                                            width="50px" height="20px" style="border-radius: 100%;">
                                                    </div>
                                                    <div style="flex-grow: 1; margin-right: 15px;">
                                                        <h4><i>{{ Auth::check() ? Auth::user()->name : '' }}</i></h4>
                                                        <textarea name="content" class="form-control" placeholder="Viết bình luận" required
                                                            style="width: 400px; height:120px;border: 1px solid white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"></textarea>
                                                        <button type="submit" class="btn btn-primary btn-block mt-3 "
                                                            style="font-weight: bold; "><i class="fa fa-paper-plane"></i>
                                                            Post
                                                            Comment</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Column for displaying comments -->
                                <div class="col-lg-6">
                                    <div class="review_address_inner"
                                        style="overflow: auto; height: 500px; padding: 10px;">
                                        @foreach ($product->comments as $comment)
                                            <div class="pro_review"
                                                style="display: flex; align-items: center; margin-bottom: 20px;">
                                                <div class="review_thumb" style="margin-right: 15px;">
                                                    <img alt="review images"
                                                        src="{{ Storage::url(Auth::check() ? Auth::user()->photo_thumbs : '') }}"
                                                        width="50px" height="20px" style="border-radius: 100%;">
                                                </div>
                                                <div class="review_details" style="flex-grow: 1;">
                                                    <div
                                                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                                        <div>
                                                            <h4><i><a href="#">{{ $comment->user->name }}</a></i>
                                                            </h4>
                                                            <ul class="product-rating d-flex" style="margin-right: 10px;">
                                                                @for ($i = 0; $i < 5; $i++)
                                                                    @if ($i < $comment->rating)
                                                                        <li><span class="fa fa-star"
                                                                                style="color: #ffc107;"></span></li>
                                                                    @else
                                                                        <li><span class="fa fa-star"></span></li>
                                                                    @endif
                                                                @endfor
                                                            </ul>

                                                        </div>
                                                        @if (Auth::check() && Auth::id() === $comment->user_id)
                                                            <div style="float:right; margin-right:20px;">
                                                                <a href="#"
                                                                    onclick="event.preventDefault(); document.getElementById('delete-comment-{{ $comment->id }}').submit();"
                                                                    style="font-weight: bold; color: #dc3545; font-size: 25px;"><i
                                                                        class="fa fa-trash"></i></a>
                                                                <form id="delete-comment-{{ $comment->id }}"
                                                                    action="{{ route('product.comment.delete', $comment->id) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <p style="margin-bottom: 10px;"> <span
                                                            class="badge bg-success text-center"
                                                            height="20px;">{{ $comment->content }}</span></p>
                                                    <div>
                                                        <span
                                                            class="review_date">{{ $comment->created_at->format('d M, Y \a\t h:i a') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>





                        <!-- End Single COMMENT -->



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->


    <!-- Product Area Start -->
    <div class="product-area section-pt">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section-title start -->
                    <div class="section-title section-bg-2">
                        <h2>Other Products</h2>
                        <p>Most Trendy 2023 Clother</p>
                    </div>
                    <!-- section-title end -->
                </div>
            </div>
            <!-- product-wrapper start -->
            <div class="product-wrapper-tab-panel">
                <!-- tab-contnt start -->
                <div class="product-slider">
                    <!-- single-product-wrap start -->
                    @foreach ($relateproduct as $relate)
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="{{ route('client.show', $relate->id) }}">
                                    <img class="img-fluid" src="{{ Storage::url($relate->img_thumbnail) }}"
                                        alt="">
                                </a>
                                <span class="label-product label-new">new</span>

                                @if ($relate->sales->isNotEmpty() && $relate->sales->first()->pivot && $relate->sales->first()->status)
                                    @php
                                        $discountPercentage =
                                            (($relate->price - $relate->sales->first()->pivot->sale_price) /
                                                $relate->price) *
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
                                <h3><a href="{{ route('client.show', $relate->id) }}">{{ $relate->name }}</a></h3>
                                <div class="price-box">
                                    @if ($relate->sales->isNotEmpty() && $relate->sales->first()->pivot && $relate->sales->first()->status)
                                        <span class="old-price">{{ number_format($relate->price, 0, ',', '.') }}
                                            VNĐ</span>
                                        <span
                                            class="new-price">{{ number_format($relate->sales->first()->pivot->sale_price, 0, ',', '.') }}
                                            VNĐ</span>
                                    @else
                                        <span class="new-price">{{ number_format($relate->price, 0, ',', '.') }}
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
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function updateQuantity() {
            var colorId = document.querySelector('input[name="product_color_id"]:checked').value;
            var sizeId = document.querySelector('input[name="product_size_id"]:checked').value;

            // Gọi AJAX để lấy số lượng có sẵn dựa trên colorId và sizeId
            fetch(
                    `/api/product/quantity?product_id={{ $product->id }}&product_color_id=${colorId}&product_size_id=${sizeId}`
                )
                .then(response => response.json())
                .then(data => {
                    document.getElementById('available_quantity').value = data.quantity;
                })
                .catch(error => console.error('Error fetching available quantity:', error));
        }

        // Gọi hàm updateQuantity khi trang được tải và khi người dùng thay đổi lựa chọn màu sắc hoặc kích cỡ
        document.addEventListener('DOMContentLoaded', function() {
            var radios = document.querySelectorAll('input[name="product_color_id"], input[name="product_size_id"]');
            radios.forEach(radio => {
                radio.addEventListener('change', updateQuantity);
            });

            // Khởi động để lấy số lượng có sẵn ban đầu khi trang được tải
            updateQuantity();
        });

        // Hàm cập nhật ảnh gallery khi thay đổi màu sắc
        function updateGalleryImage() {
            var colorId = $('input[name="color"]:checked').val();
            var galleryId = $('input[name="color"]:checked').data('gallery');

            if (galleryId) {
                var imageUrl = '{{ Storage::url('galleries/') }}' + '/' + galleryId + '.jpg';
                // Đặt lại src của ảnh trong s_Product_carousel
                $('.single-prd-item').removeClass('active'); // Xóa lớp 'active' khỏi tất cả các item
                $('#galleryImage' + galleryId).addClass('active'); // Thêm lớp 'active' vào item được chọn
                $('#galleryImage' + galleryId + ' img').attr('src', imageUrl); // Cập nhật src của ảnh
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <script>
        document.getElementById('variantForm').addEventListener('submit', function(event) {
            var quantityInput = document.getElementById('quantity_add');
            var availableQuantityInput = document.getElementById('available_quantity');
            var quantity = parseInt(quantityInput.value);
            var availableQuantity = parseInt(availableQuantityInput.value);

            if (quantity <= 0 || quantity > availableQuantity) {
                event.preventDefault(); // Prevent form submission
                alert('Hết số lượng'); // Display out of stock message
            }
        });
    </script>
    <script>
        // Ajax request for posting a comment
        function postComment(event) {
            event.preventDefault();

            var formData = new FormData(event.target);
            var url = event.target.action;

            fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Append new comment to the comments list
                    var commentHTML = `
                    <div class="pro_review" style="display: flex; align-items: center; margin-bottom: 20px;">
                        <div class="review_thumb" style="margin-right: 15px;">
                            <img alt="review images" src="{{ asset('assets/images/about1.jpg') }}" width="70px" height="70px" style="border-radius: 50%;">
                        </div>
                        <div class="review_details" style="flex-grow: 1;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <div>
                                    <h4><a href="#">{{ Auth::check() ? Auth::user()->name : '' }}</a></h4>
                                    <ul class="product-rating d-flex" style="margin-right: 10px;">
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star"></span></li>
                                        <li><span class="fa fa-star"></span></li>
                                    </ul>
                                </div>
                                <div>
                                    <a href="#" onclick="deleteComment(${data.comment.id})" style="font-weight: bold; color: #dc3545; font-size: 18px;"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                            <p style="margin-bottom: 10px;">${data.comment.content}</p>
                            <div>
                                <span class="review_date">${data.comment.created_at}</span>
</div>
                        </div>
                    </div>`;

                    // Append new comment to the review_address_inner element
                    document.querySelector('.review_address_inner').innerHTML += commentHTML;
                    // Clear the textarea after posting
                    event.target.querySelector('textarea').value = '';
                })
                .catch(error => console.error('Error posting comment:', error));
        }

        // Ajax request for deleting a comment
        function deleteComment(commentId) {
            var url = '{{ route('product.comment.delete', ':commentId') }}'.replace(':commentId', commentId);

            fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Remove the deleted comment from the DOM
                    var commentElement = document.getElementById('comment-' + commentId);
                    if (commentElement) {
                        commentElement.remove();
                    }
                })
                .catch(error => console.error('Error deleting comment:', error));
        }
    </script>
     <script>
        document.getElementById('increment').addEventListener('click', function() {
            var quantityInput = document.getElementById('quantity_add');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });

        document.getElementById('decrement').addEventListener('click', function() {
            var quantityInput = document.getElementById('quantity_add');
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });
    </script>

@endsection
