@extends('client.layout.inheritance')

@section('styles')
    <style>
        .card_area .add-to-cart {
            color: white;
            background-color: black;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* CSS for hover effect */
        .card_area .add-to-cart:hover {
            background-color: gray;
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
    </style>
@endsection

@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->


    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-details-left">

                        <div class="product-details-images slider-lg-image-1">
                            @foreach ($product->galleries as $gallery)
                                <div class="lg-image">
                                    <a href="{{ Storage::url($gallery->image) }}" class="img-poppu"><img class="img-fluid"
                                            src="{{ Storage::url($gallery->image) }}" alt="product image"></a>
                                </div>
                            @endforeach
                        </div>
                        {{-- @foreach ($product->galleries as $gallery)
                            <div class="product-details-thumbs slider-thumbs-1">
                                <img class="img-fluid" src="{{ Storage::url($gallery->image) }}" alt="product image"></a>
                            </div>
                        @endforeach --}}
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content">
                        <div class="product-info">
                            <h2>{{ $product->name }}</h2>
                            <div class="price-box">
                                {{-- <span class="old-price">$70.00</span> --}}
                                <span class="new-price">${{ $product->price }}</span>
                                <span class="discount discount-percentage">Save 5%</span>
                            </div>
                            <p>{{ $product->content }}</p>


                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="available_quantity">Available Quantity:</label>
                                    <input type="text" class="form-control" id="available_quantity"
                                        name="available_quantity" readonly>
                                </div>

                                <form id="variantForm" action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <div class="form-group">
                                        <label for="color">Color:</label>
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
                                                            <span>{{ $variant->color->name }}</span>
                                                            <img src="{{ Storage::url($variant->image) }}"
                                                                alt="{{ $variant->color->name }}"
                                                                style="width: 40px; height: 40px; object-fit: cover; margin-left: 8px;">
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="size">Size:</label>
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
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" class="form-control" id="quantity_add" name="quantity_add"
                                            min="1" value="1">
                                    </div>

                                    <div class="card_area d-flex align-items-center">
                                        <button type="submit" class="add-to-cart">Add to Cart</button>
                                    </div>
                                </form>
                            </div>

                            <div class="product-availability">
                                <i class="fa fa-check"></i> In stock
                            </div>
                            <div class="product-social-sharing">
                                <label>Share</label>
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
                                            <p>Security policy (edit with Customer reassurance module)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-truck"></i>
                                            </div>
                                            <p>Delivery policy (edit with Customer reassurance module)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-exchange"></i>
                                            </div>
                                            <p> Return policy (edit with Customer reassurance module)</p>
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
                                <a data-bs-toggle="tab" role="tab" href="#sheet">Product Details</a>
                            </li>
                            <li role="presentation">
                                <a data-bs-toggle="tab" role="tab" href="#reviews">Reviews</a>
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
                                    <h2 class="title_3">Details</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit
                                        ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                        mollit anim id.</p>
                                </div>
                                <div class="pro_feature">
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
                                </div>
                            </div>
                        </div>
                        <!-- End Single Content -->
                        <!-- Start Single Content -->
                        <div class="product_tab_content tab-pane" id="sheet" role="tabpanel">
                            <div class="pro_feature">
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
                        <!-- Start Single Content -->
                        <div class="product_tab_content tab-pane" id="reviews" role="tabpanel">
                            <div class="review_address_inner">
                                <!-- Start Single Review -->
                                <div class="pro_review">
                                    <div class="review_thumb">
                                        <img alt="review images" src="assets/images/review/1.jpg">
                                    </div>
                                    <div class="review_details">
                                        <div class="review_info">
                                            <h4><a href="#">Gerald Barnes</a></h4>
                                            <ul class="product-rating d-flex">
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                            </ul>
                                            <div class="rating_send">
                                                <a href="#"><i class="fa fa-reply"></i></a>
                                            </div>
                                        </div>
                                        <div class="review_date">
                                            <span>27 Jun, 2023 at 3:30pm</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas
                                            elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent
                                            et messages in con sectetur posuere dolor non.</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                                <!-- Start Single Review -->
                                <div class="pro_review ans">
                                    <div class="review_thumb">
                                        <img alt="review images" src="assets/images/review/2.jpg">
                                    </div>
                                    <div class="review_details">
                                        <div class="review_info">
                                            <h4><a href="#">Gerald Barnes</a></h4>
                                            <ul class="product-rating d-flex">
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                                <li><span class="fa fa-star"></span></li>
                                            </ul>
                                            <div class="rating_send">
                                                <a href="#"><i class="fa fa-reply"></i></a>
                                            </div>
                                        </div>
                                        <div class="review_date">
                                            <span>27 Jun, 2023 at 4:32pm</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas
                                            elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent
                                            et messages in con sectetur posuere dolor non.</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                            </div>
                            <!-- Start RAting Area -->
                            <div class="rating_wrap">
                                <h2 class="rating-title">Write A review</h2>
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
                            <!-- End RAting Area -->
                            <div class="comments-area comments-reply-area">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="#" class="comment-form-area">
                                            <div class="comment-input">
                                                <p class="comment-form-author">
                                                    <label>Name <span class="required">*</span></label>
                                                    <input type="text" required="required" name="Name">
                                                </p>
                                                <p class="comment-form-email">
                                                    <label>Email <span class="required">*</span></label>
                                                    <input type="text" required="required" name="email">
                                                </p>
                                            </div>
                                            <p class="comment-form-comment">
                                                <label>Comment</label>
                                                <textarea class="comment-notes" required="required"></textarea>
                                            </p>
                                            <div class="comment-form-submit">
                                                <input type="submit" value="Post Comment" class="comment-submit">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Content -->
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
            <div class="product-wrapper">
                <div class="row product-slider">
                    <div class="col-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img src="assets/images/product/9.jpg" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-9%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">Fusce nec facilisi</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$53.27</span>
                                    <span class="old-price">$58.49</span>
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
                        <!-- single-product-wrap end -->
                    </div>
                    <div class="col-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img src="assets/images/product/4.jpg" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-7%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">Sprite Yoga Straps1</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$57.27</span>
                                    <span class="old-price">$52.49</span>
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
                        <!-- single-product-wrap end -->
                    </div>
                    <div class="col-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img src="assets/images/product/5.jpg" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-7%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">Wrinted Summer Dress</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$51.27</span>
                                    <span class="old-price">$54.49</span>
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
                        <!-- single-product-wrap end -->
                    </div>
                    <div class="col-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img src="assets/images/product/6.jpg" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-4%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">Printed Dress</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$91.27</span>
                                    <span class="old-price">$84.49</span>
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
                        <!-- single-product-wrap end -->
                    </div>
                    <div class="col-12">
                        <!-- single-product-wrap start -->
                        <div class="single-product-wrap">
                            <div class="product-image">
                                <a href="product-details.html"><img src="assets/images/product/7.jpg" alt=""></a>
                                <span class="label-product label-new">new</span>
                                <span class="label-product label-sale">-7%</span>
                                <div class="quick_view">
                                    <a href="#" title="quick view" class="quick-view-btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="product-details.html">Printed Summer Dress</a></h3>
                                <div class="price-box">
                                    <span class="new-price">$51.27</span>
                                    <span class="old-price">$54.49</span>
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
                        <!-- single-product-wrap end -->
                    </div>
                </div>
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
@endsection
