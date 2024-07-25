@extends('client.layouts.master')
@section('title', 'Shop')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.css">

    <style>
        /* Đặt giá trị mặc định cho các phần tử đầu vào */
        .price-range-values input {
            border: none;
            background: none;
            width: 70px;
            font-size: 14px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 10px;
        }

        /* Đặt khoảng cách và hiển thị linh hoạt */
        .price-range-values {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        /* Đặt phong cách cho tiêu đề và thanh trượt */
        .product-filter h5 {
            margin-top: 20px;
            font-weight: bold;
            color: #000;
        }

        /* Đặt phong cách cho noUiSlider */
        .noUi-target {
            background: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 4px;
            height: 8px;
            /* Giảm chiều cao của thanh trượt */
        }

        .noUi-horizontal .noUi-handle {
            border: none;
            background: #000;
            /* Đổi màu nút tròn thành màu đen */
            width: 16px;
            height: 16px;
            border-radius: 50%;
            top: -4px;
            /* Điều chỉnh vị trí nút tròn */
        }

        .noUi-connect {
            background: #000;
            /* Đổi màu thanh trượt thành màu đen */
            height: 8px;
            /* Giảm chiều cao của thanh trượt */
        }
    </style>
@endsection
@section('content')
    <div class="content-wraper">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar">
                        <div class="product-select-box">

                            <div class="product-filter">
                                <h3 style="font-weight: bold">Filters</h3>
                                <h5 style="font-weight: bold">Price</h5>
                                <div id="price_range"></div>
                                <div class="price-range-values">
                                    <input type="text" id="min_price" readonly>
                                    <input type="text" id="max_price" readonly>
                                </div>
                                <h5 style="font-weight: bold">Categories</h5>
                                <form id="category_filter_form">
                                    {{-- <div>
                                        <input type="checkbox" id="category_all" name="category_filter[]" value="" onclick="applyFilters()">
                                        <label for="category_all">All Categories</label>
                                    </div> --}}
                                    @foreach ($categories as $category)
                                        <div>
                                            <input type="checkbox" id="category_{{ $category->id }}"
                                                name="category_filter[]" value="{{ $category->id }}"
                                                onclick="applyFilters()">
                                            <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                </form>
                                <h5 style="font-weight: bold">Brands</h5>
                                <form id="brand_filter_form">
                                    @foreach ($brands as $brand)
                                        <div>
                                            <input type="checkbox" id="brand_{{ $brand->id }}" name="brand_filter[]"
                                                value="{{ $brand->id }}" onclick="applyFilters()">
                                            <label for="brand_{{ $brand->id }}">{{ $brand->name }}</label>
                                        </div>
                                    @endforeach
                                </form>
                                <h5 style="font-weight: bold">Colors</h5>
                                <h5 style="font-weight: bold">Sizes</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop-wrapper-tab-panel">
                        <div class="shop-slider">
                            <div class="shop-product-area">
                                <div class="product-short">
                                    <select style="border-radius: 10px;" class="nice-select" id="sort_by" name="sort_by"
                                        onchange="applyFilters()">
                                        <option value="relevance">Lọc theo sản phẩm</option>
                                        <option value="name_asc">Name (A - Z)</option>
                                        <option value="name_desc">Name (Z - A)</option>
                                        <option value="price_asc">Price (Low > High)</option>
                                        <option value="price_desc">Price (High > Low)</option>
                                        <option value="rating_asc">Rating (Lowest)</option>
                                        <option value="rating_desc">Rating (Highest)</option>
                                    </select>
                                </div>
                                <div class="row" id="product_list">
                                    @foreach ($products as $product)
                                        <div class="col-lg-4 col-md-4 col-sm-6 mt-30">
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="{{ route('client.show', $product->id) }}">
                                                        <img class="img-fluid"
                                                            src="{{ Storage::url($product->img_thumbnail) }}"
                                                            alt="">
                                                    </a>
                                                    <span class="label-product label-new">new</span>
                                                    @if ($product->sales->isNotEmpty() && $product->sales->first()->pivot && $product->sales->first()->status)
                                                        @php
                                                            $discountPercentage =
                                                                (($product->price -
                                                                    $product->sales->first()->pivot->sale_price) /
                                                                    $product->price) *
                                                                100;
                                                        @endphp
                                                        <span
                                                            class="label-product label-sale">-{{ round($discountPercentage, 0) }}%</span>
                                                    @endif
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
                                                        @if ($product->sales->isNotEmpty() && $product->sales->first()->pivot && $product->sales->first()->status)
                                                            <span
                                                                class="old-price">{{ number_format($product->price, 0, ',', '.') }}
                                                                VNĐ</span>
                                                            <span
                                                                class="new-price">{{ number_format($product->sales->first()->pivot->sale_price, 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @else
                                                            <span
                                                                class="new-price">{{ number_format($product->price, 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @endif
                                                    </div>
                                                    <div class="product-action">
                                                        <button class="add-to-cart" title="Add to cart"><i
                                                                class="fa fa-plus"></i> Add to cart</button>
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
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const minPrice = localStorage.getItem('min_price');
            const maxPrice = localStorage.getItem('max_price');
            const sortBy = localStorage.getItem('sort_by');
            const categoryFilters = JSON.parse(localStorage.getItem('category_filters') || '[]');
            const brandFilters = JSON.parse(localStorage.getItem('brand_filters') || '[]');

            if (minPrice) document.getElementById('min_price').value = minPrice;
            if (maxPrice) document.getElementById('max_price').value = maxPrice;
            if (sortBy) document.getElementById('sort_by').value = sortBy;

            categoryFilters.forEach(category => {
                document.getElementById('category_' + category).checked = true;
            });

            brandFilters.forEach(brand => {
                document.getElementById('brand_' + brand).checked = true;
            });

            var priceRangeSlider = document.getElementById('price_range');

            noUiSlider.create(priceRangeSlider, {
                start: [minPrice, maxPrice],
                connect: true,
                range: {
                    'min': 0,
                    'max': 1000000
                }
            });

            var minPriceInput = document.getElementById('min_price');
            var maxPriceInput = document.getElementById('max_price');

            priceRangeSlider.noUiSlider.on('update', function(values, handle) {
                if (handle) {
                    maxPriceInput.value = values[handle];
                } else {
                    minPriceInput.value = values[handle];
                }
            });

            priceRangeSlider.noUiSlider.on('change', function() {
                applyFilters();
            });
        });

        function applyFilters() {
            var minPrice = document.getElementById('min_price').value;
            var maxPrice = document.getElementById('max_price').value;
            var sortBy = document.getElementById('sort_by').value;

            var selectedCategories = [];
            var selectedBrands = [];

            document.querySelectorAll('#category_filter_form input[type="checkbox"]:checked').forEach(function(checkbox) {
                selectedCategories.push(checkbox.value);
            });

            document.querySelectorAll('#brand_filter_form input[type="checkbox"]:checked').forEach(function(checkbox) {
                selectedBrands.push(checkbox.value);
            });

            localStorage.setItem('min_price', minPrice);
            localStorage.setItem('max_price', maxPrice);
            localStorage.setItem('sort_by', sortBy);
            localStorage.setItem('category_filters', JSON.stringify(selectedCategories));
            localStorage.setItem('brand_filters', JSON.stringify(selectedBrands));

            var params = new URLSearchParams();
            if (minPrice) params.append('min_price', minPrice);
            if (maxPrice) params.append('max_price', maxPrice);
            if (sortBy) params.append('sort_by', sortBy);
            selectedCategories.forEach(category => params.append('category_filter[]', category));
            selectedBrands.forEach(brand => params.append('brand_filter[]', brand));

            var url = '{{ route('shop') }}?' + params.toString();
            window.location.href = url;
        }
    </script>
@endsection
