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
    </style>
@endsection
@section('content')
    <div class="content-wraper">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <!-- Tìm kiếm -->
                        <div class="col-md-12 mb-3">
                            <form id="searchForm" action="{{ route('shop') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Tìm kiếm...">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </form>
                        </div>

                        <!-- Category Filter Form -->
                        <h5 style="font-weight: bold">
                            <a class="text-decoration-none" data-bs-toggle="collapse" href="#categoryMenu" role="button"
                                aria-expanded="false" aria-controls="categoryMenu">
                                Categories
                            </a>
                        </h5>
                        <div class="collapse" id="categoryMenu">
                            <form id="category_filter_form">
                                @foreach ($categories as $category)
                                    <div>
                                        <input type="checkbox" id="category_{{ $category->id }}" name="category_filter[]"
                                            value="{{ $category->id }}" onclick="applyFilters()">
                                        <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </form>
                        </div>

                        <!-- Brand Filter Form -->
                        <h5 style="font-weight: bold">
                            <a class="text-decoration-none" data-bs-toggle="collapse" href="#brandMenu" role="button"
                                aria-expanded="false" aria-controls="brandMenu">
                                Brands
                            </a>
                        </h5>
                        <div class="collapse" id="brandMenu">
                            <form id="brand_filter_form">
                                @foreach ($brands as $brand)
                                    <div>
                                        <input type="checkbox" id="brand_{{ $brand->id }}" name="brand_filter[]"
                                            value="{{ $brand->id }}" onclick="applyFilters()">
                                        <label for="brand_{{ $brand->id }}">{{ $brand->name }}</label>
                                    </div>
                                @endforeach
                            </form>
                        </div>

                        {{-- <!-- Size Filter Form -->
                        <h5 style="font-weight: bold">
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
                        <h5 style="font-weight: bold">
                            <a class="text-decoration-none" data-bs-toggle="collapse" href="#priceMenu" role="button"
                                aria-expanded="false" aria-controls="priceMenu">
                                Price
                            </a>
                        </h5>
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
            {{ $products->links() }}
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
@endsection
