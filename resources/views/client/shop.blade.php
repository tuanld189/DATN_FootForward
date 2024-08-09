@extends('client.layouts.master')
@section('title', 'Shop')
@section('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        #priceMenu {
            padding: 15px;
            background-color: #f8f9fa;
            /* Light background for contrast */
            border: 1px solid #ddd;
            /* Border for definition */
            border-radius: 5px;
            /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
        }

        #price_filter_form {
            display: flex;
            flex-direction: column;
        }

        .price-slider {
            margin-bottom: 15px;
        }

        .price-inputs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .price-input-group {
            flex: 1;
            margin-right: 10px;
        }

        .price-input-group:last-child {
            margin-right: 0;
        }

        .price-input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .price-input-wrapper {
            display: flex;
            align-items: center;
        }

        .price-input-wrapper input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            margin-right: 5px;
        }

        .currency-symbol {
            font-size: 16px;
            color: #333;
        }

        #apply_price_filter {
            align-self: flex-end;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            /* Primary color */
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #apply_price_filter:hover {
            background-color: #0056b3;
            /* Darker shade on hover */
        }
        .carousel-item {
            transition: transform 0.5s ease-in-out;
        }

        
        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: #8a8f6a;
        }

        .banner-image {
            position: relative;
        }

        .banner-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 10px;
            text-align: center;
            color:while;
        }

        .banner-overlay h5 {
            margin: 0;
        }


        /* check box */
        .category-menu {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            margin: 0 0 10px 0;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .checkbox-container input[type="checkbox"] {
            display: none;
        }

        .checkbox-container label {
            position: relative;
            padding-left: 30px;
            cursor: pointer;
            font-size: 16px;
            color: #333;
            display: inline-block;
        }

        .checkbox-container label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 4px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .checkbox-container input[type="checkbox"]:checked + label::before {
            background-color: #8a8f6a;
            border-color: #8a8f6a;
        }

        .checkbox-container input[type="checkbox"]:checked + label::after {
            content: '✔';
            position: absolute;
            left: 4px;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            font-size: 16px;
        }
      

    </style>
@endsection
@section('content')
    <div class="content-wraper" >
        <div class="container" >
           {{-- <div id="categoryCarousel" class="carousel slide mb--30" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($categories->chunk(2) as $key => $chunk)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $category)
                                    <div class="col-lg-6 col-md-12">
                                        <!-- single-banner start -->
                                        <div class="single-banner ">
                                            <a href="{{ $category->link }}">
                                                <div class="banner-image">
                                                    <img src="{{ $category->image }}" alt=""
                                                        style="width: 100%; height: 270px; object-fit: cover;">
                                                    <div class="banner-overlay">
                                                        <h5 style="color:white;">{{ $category->name }}</h5>
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

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            --}}

            <div class="row">
                <div class="col-lg-3">
                    <div class="row" style="height: 300px;">
                        <!-- Tìm kiếm -->
                        <div class="col-md-12 shadow-lg" style="padding: 10px 0 0 15px;height: 60px;    background-color: #8a8f6a4a;">
                            <form id="searchForm" action="{{ route('shop') }}" method="GET" style=" width:250px;                                                                                                                                     ">
                                <div class="input-group" >
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Tìm kiếm..." style="border-radius: 10px 0 0 10px;border: 1px solid white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    <button type="submit" class="btn btn-primary" style="border-radius: 0 10px 10px 0;border: 1px solid #8a8f6a;">Tìm kiếm</button>
                                </div>
                            </form>
                        </div>

                        <!-- Category Filter Form -->
                        <div class="text-decoration-none" data-bs-toggle="collapse" href="#categoryMenu" 
                        aria-expanded="false" aria-controls="categoryMenu" style="width: 300px;height: 40px;background-color: #8a8f6a4a;padding: 10px 5px; margin-bottom: 5px;border-radius: 10px; margin-top: 35px;" >
                            <h5 style="font-weight: bold;color: #8a8f6a;" >
                                <a>
                                    Danh mục giày
                                </a>
                            </h5>
                            
                        </div>
                        <div class="category-menu" id="categoryMenu">
                            <form id="category_filter_form">
                                @foreach ($categories as $category)
                                    <div class="checkbox-container">
                                        <input type="checkbox" id="category_{{ $category->id }}" name="category_filter[]"
                                            value="{{ $category->id }}" onclick="applyFilters()">
                                        <label for="category_{{ $category->id }}" class="checkbox-label">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </form>
                        </div>


                        <!-- Brand Filter Form -->
                        <div class="text-decoration-none" data-bs-toggle="collapse" href="#brandMenu" role="button" aria-expanded="false" aria-controls="brandMenu" style="width: 300px;height: 40px;background-color: #8a8f6a4a;padding: 10px 5px; margin-bottom: 5px;border-radius: 10px;">
                            <h5 style="font-weight: bold;color: #8a8f6a;">
                                <a>
                                    Thương hiểu giày
                                </a>
                            </h5>
                        </div>
                        <div class="category-menu" id="brandMenu">
                            <form id="brand_filter_form">
                                @foreach ($brands as $brand)
                                    <div class="checkbox-container">
                                        <input type="checkbox" id="brand_{{ $brand->id }}" name="brand_filter[]"
                                            value="{{ $brand->id }}" onclick="applyFilters()">
                                        <label for="brand_{{ $brand->id }}" class="checkbox-label">{{ $brand->name }}</label>
                                    </div>
                                @endforeach
                            </form>
                        </div>

                        {{-- <!-- Size Filter Form -->
                        <h5 style="font-weight: bold;color: #8a8f6a;">
                            <a class="text-decoration-none" data-bs-toggle="collapse" href="#sizeMenu" role="button"
                                aria-expanded="false" aria-controls="sizeMenu">
                                Sizes
                            </a>
                        </h5>
                        <div class="collapse" id="sizeMenu">
                            <form id="size_filter_form">
                                @foreach ($sizes as $id => $size)
                                    <div>
                                        <input type="checkbox" id="size_{{ $id }}" name="size_filter[]"
                                            value="{{ $id }}" onclick="applyFilters()">
                                        <label for="size_{{ $id }}">{{ $size }}</label>
                                    </div>
                                @endforeach
                            </form>
                        </div> --}}

                        {{-- <!-- Color Filter Form -->
                        <h5 style="font-weight: bold">
                            <a class="text-decoration-none" data-bs-toggle="collapse" href="#colorMenu" role="button"
                                aria-expanded="false" aria-controls="colorMenu">
                                Colors
                            </a>
                        </h5>
                        <div class="collapse" id="colorMenu">
                            <form id="color_filter_form">
                                @foreach ($colors as $id => $color)
                                    <div>
                                        <input type="checkbox" id="color_{{ $id }}" name="color_filter[]"
                                            value="{{ $id }}" onclick="applyFilters()">
                                        <label for="color_{{ $id }}">{{ $color }}</label>
                                    </div>
                                @endforeach
                            </form>
                        </div> --}}
                        <!-- Price Filter Form -->
                        <div class="text-decoration-none" data-bs-toggle="collapse" href="#priceMenu" role="button"
                        aria-expanded="false" aria-controls="priceMenu" style="width: 300px;height: 40px;background-color: #8a8f6a4a;padding: 10px 5px; margin-bottom: 5px;border-radius: 10px;">
                        <h5 style="font-weight: bold;color: #8a8f6a;">
                            <a class="text-decoration-none"  href="#priceMenu" role="button"
                                aria-expanded="false" aria-controls="priceMenu">
                                Giá giày
                            </a>
                        </h5>
                        </div>
                        <div class="collapse" id="priceMenu">
                            <form id="price_filter_form" action="{{ route('shop') }}" method="GET">
                                <div id="price_slider" class="price-slider"></div>
                                <div class="price-inputs">
                                    <div class="price-input-group">
                                        <label for="price_min">Min Price:</label>
                                        <div class="price-input-wrapper">
                                            <input type="text" id="price_min" name="price_min" readonly>
                                            <span class="currency-symbol">đ-</span>
                                        </div>
                                    </div>
                                    <div class="price-input-group">
                                        <label for="price_max">Max Price:</label>
                                        <div class="price-input-wrapper">
                                            <input type="text" id="price_max" name="price_max" readonly>
                                            <span class="currency-symbol">đ</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="row" id="product_list">
                        @include('client.product-list') <!-- Load initial product list -->
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Khởi tạo thanh trượt giá
            $("#price_slider").slider({
                range: true,
                min: 0,
                max: 1000000, // Set maximum value as needed
                step: 1000,
                values: [
                    parseFloat($('#price_min').val()) || 0,
                    parseFloat($('#price_max').val()) || 1000
                ],
                slide: function(event, ui) {
                    $("#price_min").val(ui.values[0]);
                    $("#price_max").val(ui.values[1]);
                },
                change: function(event, ui) {
                    // Trigger price filter on change
                    applyPriceFilter();
                }
            });

            // Xử lý sự kiện apply price filter
            document.getElementById('apply_price_filter').addEventListener('click', function() {
                // Gửi yêu cầu AJAX để áp dụng bộ lọc giá
                applyPriceFilter();
            });

            // Xử lý sự kiện thay đổi bộ lọc chung (như category, brand, size, color)
            document.querySelectorAll(
                '#category_filter_form input[type=checkbox], #brand_filter_form input[type=checkbox], #size_filter_form input[type=checkbox], #color_filter_form input[type=checkbox]'
            ).forEach(item => {
                item.addEventListener('change', applyFilters);
            });
        });

        function applyFilters() {
            // Xử lý các bộ lọc chung
            let categoryFilters = $('#category_filter_form').serialize();
            let brandFilters = $('#brand_filter_form').serialize();
            let sizeFilters = $('#size_filter_form').serialize();
            let colorFilters = $('#color_filter_form').serialize();

            // Kết hợp các bộ lọc chung
            let generalFilters = [categoryFilters, brandFilters, sizeFilters, colorFilters].join('&');

            // Gửi yêu cầu AJAX với các bộ lọc chung
            $.ajax({
                url: '{{ route('shop') }}',
                type: 'GET',
                data: generalFilters,
                beforeSend: function() {
                    // Optional loading animation
                },
                success: function(data) {
                    $('#product_list').html(data.product_list);
                    // $('#pagination').html(data.pagination);
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', xhr.responseText);
                    alert('Không thể tải sản phẩm.');
                }
            });
        }

        function applyPriceFilter() {
            // Lấy dữ liệu bộ lọc giá từ form
            let priceFilters = $('#price_filter_form').serialize();

            // Gửi yêu cầu AJAX để lọc sản phẩm theo giá
            $.ajax({
                url: '{{ route('shop') }}',
                type: 'GET',
                data: priceFilters,
                beforeSend: function() {
                    // Optional loading animation
                },
                success: function(data) {
                    $('#product_list').html(data.product_list);
                    // $('#pagination').html(data.pagination);
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', xhr.responseText);
                    alert('Không thể tải sản phẩm.');
                }
            });
        }
    </script>
    <script>
       document.addEventListener('DOMContentLoaded', function () {
            var myCarousel = document.querySelector('#categoryCarousel');
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 5000, // Chuyển đổi mỗi 5 giây
                wrap: true
            });
        });

    </script>
    <script>
    $(function() {
        $("#price_slider").slider({
            range: true,
            min: 0,
            max: 1000,
            values: [100, 500],
            slide: function(event, ui) {
                $("#price_min").val(ui.values[0]);
                $("#price_max").val(ui.values[1]);
            }
        });

        $("#price_min").val($("#price_slider").slider("values", 0));
        $("#price_max").val($("#price_slider").slider("values", 1));
    });
</script>   
@endsection
