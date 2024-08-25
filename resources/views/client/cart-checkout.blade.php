@extends('client.layouts.master')

@section('styles')
    <style>
        .no-border-corners {
            border-top: none;
            border-left: none;
            border-right: none;
        }

        /* General Styling for the Coupon Container */
        .coupon-container {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .coupon-container h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
        }

        /* Styling for Form Control */
        .custom-input {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .custom-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
            outline: none;
        }

        /* Styling for Button */
        .custom-button {
            border: none;
            border-radius: 4px;
            padding: 10px;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .custom-button:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Notification styling */
        #ajax-message {
            display: none;
            padding: 10px;
            border-radius: 4px;
            font-size: 0.875rem;
            margin-top: 1rem;
        }

        #ajax-message.success {
            background-color: #d4edda;
            color: #155724;
        }

        #ajax-message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
    <!-- CSS -->
    <style>
        .coupon-container {
            margin: 20px;
        }

        .table-responsive {
            max-height: 400px;
            overflow-y: auto;
            overflow-x: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .table {
            width: 100%;
            table-layout: fixed;
        }

        .table thead th {
            background-color: #f8f9fa;
            position: sticky;
            top: 0;
            z-index: 1;
            white-space: nowrap;
            padding: 8px;
            /* Giảm padding */
            font-size: 12px;
            /* Chữ nhỏ hơn */
        }

        .table td,
        .table th {
            padding: 8px;
            /* Giảm padding */
            text-align: left;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 12px;
            /* Chữ nhỏ hơn */
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        .marquee-container {
            position: relative;
            overflow: hidden;
            background: #f9f9f9;
            padding: 5px;
        }

        .marquee-text {
            display: inline-block;
            white-space: nowrap;
            padding-left: 100%;
            animation: marquee 15s linear infinite;
            font-size: 12px;
            /* Chữ nhỏ hơn */
        }

        @keyframes marquee {
            1000% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 15px;
            padding: 6px 12px;
            font-size: 14px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        /* Nếu bạn vẫn muốn hiệu ứng marquee cho tiêu đề */
        th {
            position: relative;
            overflow: hidden;
            white-space: nowrap;
            background: #f9f9f9;
            padding: 10px;
            font-size: 12px;
            /* Chữ nhỏ hơn */
        }

        .marquee-container {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .marquee {
            display: inline-block;
            padding-left: 100%;
            white-space: nowrap;
            position: absolute;
            left: 0;
            top: 0;
            animation: marquee 10s linear infinite;
            font-size: 13px;
            /* Chữ nhỏ hơn */
        }

        /* Overlay style */
        .coupon-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Nền mờ */
            display: none;
            /* Ẩn mặc định */
            align-items: center;
            justify-content: center;
            z-index: 1000;
            /* Đảm bảo nó nằm trên các phần tử khác */
        }

        /* Container style */
        .coupon-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 80%;
            transform: scale(0.8);
            /* Bắt đầu từ kích thước nhỏ */
            opacity: 0;
            /* Bắt đầu từ độ mờ */
            transition: transform 0.5s ease-out, opacity 0.5s ease-out;
            /* Hiệu ứng chuyển đổi */
        }

        /* Hiệu ứng khi hiện phần tử */
        .coupon-overlay.show .coupon-container {
            transform: scale(1);
            opacity: 1;
        }

        /* Hiệu ứng khi ẩn phần tử */
        .coupon-overlay.hide .coupon-container {
            transform: scale(0.8);
            opacity: 0;
        }

        /* Nút tắt */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            border: none;
            font-size: 24px;
            color: #000;
            cursor: pointer;
            z-index: 1100;
            /* Đặt z-index cao hơn để luôn nằm trên overlay */
        }

        /* Thay đổi màu sắc của nút tắt khi hover */
        .close-btn:hover {
            color: #f00;
        }

        .container {
            /* text-align: center; */
            /* Căn giữa nội dung bên trong phần tử chứa */
        }

        /* Nút Hiện mã giảm giá */
        #toggle-vouchers {
            background-color: #007bff;
            /* Màu nền chính của nút */
            color: #fff;
            /* Màu chữ */
            border: none;
            /* Loại bỏ viền mặc định */
            border-radius: 5px;
            /* Bo góc nút */
            padding: 10px 20px;
            /* Padding để tăng kích thước nút */
            font-size: 16px;
            /* Kích thước chữ */
            font-weight: bold;
            /* Đậm chữ */
            cursor: pointer;
            /* Con trỏ tay khi di chuột qua nút */
            transition: background-color 0.3s, transform 0.3s;
            /* Hiệu ứng chuyển đổi màu nền và hiệu ứng phóng to */
            display: inline-block;
            /* Hiển thị nút ở dạng khối nội tuyến */
            text-align: center;
            /* Căn giữa chữ trong nút */
        }

        /* Hiệu ứng khi hover */
        #toggle-vouchers:hover {
            background-color: #0056b3;
            /* Màu nền khi di chuột qua nút */
            transform: scale(1.05);
            /* Hiệu ứng phóng to nhẹ */
        }

        /* Hiệu ứng khi nút được nhấn */
        #toggle-vouchers:active {
            background-color: #004494;
            /* Màu nền khi nhấn nút */
            transform: scale(0.98);
            /* Hiệu ứng thu nhỏ nhẹ khi nhấn */
        }

        /* Hiệu ứng focus */
        #toggle-vouchers:focus {
            outline: none;
            /* Loại bỏ viền focus mặc định */
            box-shadow: 0 0 0 2px rgba(38, 143, 255, 0.5);
            /* Tạo viền focus tùy chỉnh */
        }

        .table th.col-small {
            width: 15%;
            /* Độ rộng của cột nhỏ */
        }

        .table th.col-large {
            width: 45%;
            /* Độ rộng của cột lớn */
        }

        .table td.col-small {
            width: 15%;
            /* Độ rộng của cột nhỏ trong ô dữ liệu */
        }

        .table td.col-large {
            width: 45%;
            /* Độ rộng của cột lớn trong ô dữ liệu */
        }

        /* Nếu bạn muốn các cột nhỏ hơn nữa */
        .table th.col-smaller {
            width: 10%;
            /* Độ rộng của cột cực nhỏ */
        }

        .table td.col-smaller {
            width: 10%;
            /* Độ rộng của cột cực nhỏ trong ô dữ liệu */
        }
    </style>
@endsection

@section('content')
    <div class="content-wraper mb-5">
        <div class="container">
            <!-- Breadcrumb và tiêu đề -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Thanh toán</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Thanh toán</li>
                                <li class="breadcrumb-item active">Thủ tục thanh toán</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout Details -->
            <div class="checkout-details-wrapper">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="billing-details-wrap">
                            <!-- Thông tin đặt hàng -->
                            <h3 class="shoping-checkboxt-title">Thông tin đặt hàng</h3>
                            <form action="{{ route('order.place') }}" method="POST">
                                @csrf
                                @if (Auth::check())
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="user_password" value="">
                                    <input type="hidden" name="order_code" value="{{ $orderCode }}">
                                @else
                                    <input type="hidden" name="user_id" value="{{ Str::random(10) }}">
                                    <input type="hidden" name="user_password" value="{{ Str::random(15) }}">
                                    <input type="hidden" name="order_code" value="{{ $orderCode }}">
                                @endif
                                <div class="row">
                                    <!-- Thông tin người dùng -->
                                    <div class="col-6">
                                        <p class="single-form-row">
                                            <label>Họ và tên<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="user_name"
                                                placeholder="Nhập vào tên người dùng"
                                                value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p class="single-form-row">
                                            <label>SĐT<span class="required">*</span></label>
                                            <input type="number" name="user_phone" placeholder="Nhập vào số điện thoại"
                                                value="{{ Auth::check() ? Auth::user()->phone : '' }}" class="form-control">
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p class="single-form-row">
                                            <label>Email<span class="required">*</span></label>
                                            <input type="text" name="user_email" placeholder="Nhập vào email"
                                                class="form-control"
                                                value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                        </p>
                                    </div>

                                    <div class="col-4">
                                        <p class="single-form-row">
                                            <label>Tỉnh <span class="required">*</span></label>
                                            <select class="form-control" id="province_code" name="province_code" required>
                                                <option value="">Chọn Tỉnh</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->code }}"
                                                        {{ old('province_code', optional($user)->province_code) == $province->code ? 'selected' : '' }}>
                                                        {{ $province->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="single-form-row">
                                            <label>Huyện <span class="required">*</span></label>
                                            <select class="form-control" id="district_code" name="district_code"
                                                data-selected="{{ old('district_code', Auth::check() ? Auth::user()->district_code : '') }}"
                                                required>
                                                <option value="">Chọn Huyện</option>
                                                <!-- Các huyện sẽ được điền bởi AJAX -->
                                            </select>
                                        </p>
                                    </div>
                                    <div class="col-4">
                                        <p class="single-form-row">
                                            <label>Xã <span class="required">*</span></label>
                                            <select class="form-control" id="ward_code" name="ward_code"
                                                data-selected="{{ old('ward_code', Auth::check() ? Auth::user()->ward_code : '') }}"
                                                required>
                                                <option value="">Chọn Xã</option>
                                                <!-- Các xã sẽ được điền bởi AJAX -->
                                            </select>
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p class="single-form-row m-0">
                                            <label>Ghi chú</label>
                                            <textarea placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: mua giày theo cân." class="checkout-mess" rows="2"
                                                cols="5" name="user_note"></textarea>
                                        </p>
                                    </div>
                                </div>
                                <!-- Phần thanh toán -->
                                {{-- <div class="panel-foot d-flex flex-column align-items-center m-2 p-2" style="margin-left: 35px"> --}}
                                <div class="panel-foot  p-2" style="margin-left: 35px">
                                    <h3 class="cart-heading"><span>Hình thức thanh toán</span></h3>
                                    <div class="cart-method">
                                        <label for="COD" class="uk-flex uk-flex-middle">
                                            <input type="radio" name="payment_method" value="COD" id="COD"
                                                checked>
                                            <span class="title">Thanh toán khi nhận hàng</span>
                                        </label>
                                    </div>
                                    <div class="cart-method">
                                        <label for="vnpay" class="uk-flex uk-flex-middle">
                                            <input type="radio" name="payment_method" value="vnpay" id="vnpay">
                                            <span class="title">Thanh toán bằng VNPAY</span>
                                        </label>
                                    </div>
                                    {{-- <div class="cart-method">
                                                <label for="momo" class="uk-flex uk-flex-middle">
                                                    <input type="radio" name="payment_method" value="momo" id="momo">
                                                    <span class="title">Thanh toán bằng MOMO</span>
                                                </label>
                                            </div> --}}
                                </div>
                                <div class="col-12 d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn btn-primary w-100">Đặt hàng</button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- Phần giỏ hàng và mã giảm giá -->
                    <div class="col-lg-6 col-md-6">
                        <div class="your-order-wrapper">
                            <h3 class="shoping-checkboxt-title">Giỏ hàng</h3>
                            <div class="your-order-wrap">
                                <div class="your-order-table table-responsive">
                                    {{-- <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Tên sản phẩm</th>
                                                <th class="product-name">Giá</th>
                                                <th class="product-name">Tổng cộng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $item)
                                                <tr class="cart_item">
                                                    <td class="product-name"><b>{{ $item['name'] }} <strong
                                                                class="product-quantity"> ×
                                                                {{ $item['quantity_add'] }}</strong></b></td>
                                                    <td>
                                                        @if ($item['sale_price'])
                                                            <span
                                                                class="amount old-price">{{ number_format($item['price'], 0, ',', '.') }}
                                                                VNĐ</span> <br>
                                                            <span
                                                                class="amount new-price">{{ number_format($item['sale_price'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @else
                                                            <span
                                                                class="amount">{{ number_format($item['price'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @endif
                                                    </td>
                                                    <td class="product-total">
                                                        @if ($item['sale_price'])
                                                            <span
                                                                class="amount old-price">{{ number_format($item['quantity_add'] * $item['price'], 0, ',', '.') }}
                                                                VNĐ</span> <br>
                                                            <span
                                                                class="amount new-price">{{ number_format($item['quantity_add'] * $item['sale_price'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @else
                                                            <span
                                                                class="amount new-price">{{ number_format($item['quantity_add'] * $item['price'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <!-- Total Order Amount -->
                                            <tr class="order-total">
                                                <th><b>Tổng số tiền đặt hàng</b></th>
                                                <td></td>
                                                <td>
                                                    <strong>
                                                        <span class="amount"
                                                            id="total-order-amount">{{ number_format($totalAmount + $discount, 0, ',', '.') }}
                                                            VNĐ</span>
                                                    </strong>
                                                </td>
                                            </tr>

                                            <!-- Voucher Discount -->
                                            @if ($discount > 0)
                                                <tr class="order-total">
                                                    <th><b>Mã giảm giá</b></th>
                                                    <td></td>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="amount">-{{ number_format($discount, 0, ',', '.') }}
                                                                VNĐ</span>
                                                        </strong>
                                                    </td>
                                                </tr>
                                            @endif

                                            <!-- Total Amount After Discount -->
                                            <tr class="order-total">
                                                <th><b>Tổng số tiền cần thanh toán</b></th>
                                                <td></td>
                                                <td>
                                                    <strong>
                                                        <span class="amount"
                                                            id="total-payment-amount">{{ number_format($totalAmount, 0, ',', '.') }}
                                                            VNĐ</span>
                                                    </strong>
                                                </td>
                                            </tr>
                                        </tfoot>

                                    </table> --}}

                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Tên sản phẩm</th>
                                                <th class="product-name">Giá</th>
                                                <th class="product-name">Tổng cộng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $item)
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <b>{{ $item['name'] }} <strong class="product-quantity"> ×
                                                                {{ $item['quantity_add'] }}</strong></b>
                                                    </td>
                                                    <td>
                                                        @if ($item['sale_price'])
                                                            <span
                                                                class="amount old-price">{{ number_format($item['price'], 0, ',', '.') }}
                                                                VNĐ</span> <br>
                                                            <span
                                                                class="amount new-price">{{ number_format($item['sale_price'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @else
                                                            <span
                                                                class="amount">{{ number_format($item['price'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @endif
                                                    </td>
                                                    <td class="product-total">
                                                        @if ($item['sale_price'])
                                                            <span
                                                                class="amount old-price">{{ number_format($item['quantity_add'] * $item['price'], 0, ',', '.') }}
                                                                VNĐ</span> <br>
                                                            <span
                                                                class="amount new-price">{{ number_format($item['quantity_add'] * $item['sale_price'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @else
                                                            <span
                                                                class="amount new-price">{{ number_format($item['quantity_add'] * $item['price'], 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="order-total">
                                                <th><b>Phí vận chuyển</b></th>
                                                <td></td>
                                                <td>
                                                    <strong>
                                                        @if ($shippingCost > 0)
                                                            <span
                                                                class="amount">+{{ number_format($shippingCost, 0, ',', '.') }}
                                                                VNĐ</span>
                                                        @else
                                                            <span class="amount">Miễn phí</span>
                                                        @endif
                                                    </strong>
                                                </td>
                                            </tr>
                                            <!-- Total Order Amount -->
                                            <tr class="order-total">
                                                <th><b>Tổng số tiền đặt hàng</b></th>
                                                <td></td>
                                                <td>
                                                    <strong>
                                                        <span class="amount"
                                                            id="total-order-amount">{{ number_format($totalAmount, 0, ',', '.') }}
                                                            VNĐ</span>
                                                    </strong>
                                                </td>
                                            </tr>


                                            <!-- Voucher Discount -->
                                            @if ($discount > 0)
                                                <tr class="order-total">
                                                    <th><b>Mã giảm giá</b></th>
                                                    <td></td>
                                                    <td>
                                                        <strong>
                                                            <span
                                                                class="amount">-{{ number_format($discount, 0, ',', '.') }}
                                                                VNĐ</span>
                                                        </strong>
                                                    </td>
                                                </tr>
                                            @endif

                                            <!-- Shipping Cost -->


                                            <!-- Total Amount After Discount and Shipping -->
                                            {{-- <tr class="order-total">
                                                <th><b>Tổng số tiền cần thanh toán</b></th>
                                                <td></td>
                                                <td>
                                                    <strong>
                                                        <span class="amount"
                                                            id="total-payment-amount">{{ number_format($totalAmount + $shippingCost, 0, ',', '.') }}
                                                            VNĐ</span>
                                                    </strong>
                                                </td>
                                            </tr> --}}
                                        </tfoot>
                                    </table>

                                </div>
                                <br>

                                <!-- Nút để hiện/ẩn overlay -->
                                <button id="toggle-vouchers" class="w-100">FootForward Voucher</button>
                                {{-- <div class="container">
                                    <button id="toggle-vouchers">Hiện mã giảm giá</button>
                                </div> --}}


                                <!-- Overlay chứa bảng mã giảm giá -->
                                <div id="coupon-overlay" class="coupon-overlay">
                                    <div class="coupon-container">
                                        <!-- Nút tắt -->
                                        <button id="close-voucher" class="close-btn">&times;</button>

                                        <h4 class="m-2 text-center">FootForWard Voucher</h4>
                                        <!-- Hiển thị bsảng các mã giảm giá -->
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        {{-- <th>Mã giảm giá</th>
                                                        <th>Giá trị</th>
                                                        <th>Điều kiện áp dụng</th>
                                                        <th>Chức năng</th> --}}
                                                        <th class="col-small">Mã giảm giá</th>
                                                        <th class="col-small">Giá trị</th>
                                                        <th class="col-large">Điều kiện áp dụng</th>
                                                        <th class="col-small">Chức năng</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($vourchers as $voucher)
                                                        <tr>
                                                            <td>{{ $voucher->code }}</td>
                                                            <td>
                                                                {{ $voucher->discount_value }}
                                                                {{ $voucher->discount_type == 'percentage' ? '%' : 'VNĐ' }}
                                                            </td>
                                                            <td>{{ $voucher->description }}</td>
                                                            <td>
                                                                <form action="{{ route('cart.applyVoucher') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="voucher_code"
                                                                        value="{{ $voucher->code }}">
                                                                    <button class="btn btn-primary" type="submit">Áp
                                                                        dụng</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- testtt --}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('toggle-vouchers').addEventListener('click', function() {
            var overlay = document.getElementById('coupon-overlay');
            var isShowing = overlay.classList.contains('show');

            if (isShowing) {
                overlay.classList.remove('show');
                overlay.classList.add('hide');
                setTimeout(function() {
                    overlay.style.display = 'none';
                    overlay.classList.remove('hide');
                }, 500);
                this.textContent = 'Chọn mã giảm giá';
            } else {
                overlay.style.display = 'flex';
                overlay.classList.add('show');
                this.textContent = 'CHọn mã giảm giá';
            }
        });

        document.getElementById('close-voucher').addEventListener('click', function() {
            var overlay = document.getElementById('coupon-overlay');
            overlay.classList.remove('show');
            overlay.classList.add('hide');
            setTimeout(function() {
                overlay.style.display = 'none';
                overlay.classList.remove('hide');
            }, 500);
        });
        $(document).ready(function() {
            function populateDistricts(province_code) {
                if (province_code) {
                    $.ajax({
                        url: '{{ route('get.districts', ':province_code') }}'.replace(':province_code',
                            province_code),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#district_code').empty().append('<option value="">Chọn Huyện</option>');
                            $('#ward_code').empty().append('<option value="">Chọn Xã</option>');
                            $.each(data, function(key, value) {
                                $('#district_code').append('<option value="' + value.code +
                                    '">' + value.name + '</option>');
                            });

                            // Pre-select district if user has it
                            var selectedDistrict = $('#district_code').data('selected');
                            if (selectedDistrict) {
                                $('#district_code').val(selectedDistrict).trigger('change');
                            }
                        }
                    });
                } else {
                    $('#district_code').empty().append('<option value="">Chọn Huyện</option>');
                    $('#ward_code').empty().append('<option value="">Chọn Xã</option>');
                }
            }

            function populateWards(district_code) {
                if (district_code) {
                    $.ajax({
                        url: '{{ route('get.wards', ':district_code') }}'.replace(':district_code',
                            district_code),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#ward_code').empty().append('<option value="">Chọn Xã</option>');
                            $.each(data, function(key, value) {
                                $('#ward_code').append('<option value="' + value.code + '">' +
                                    value.name + '</option>');
                            });

                            // Pre-select ward if user has it
                            var selectedWard = $('#ward_code').data('selected');
                            if (selectedWard) {
                                $('#ward_code').val(selectedWard);
                            }
                        }
                    });
                } else {
                    $('#ward_code').empty().append('<option value="">Chọn Xã</option>');
                }
            }

            // Load districts and wards on page load if province is already selected
            var initialProvince = '{{ old('province_code', Auth::check() ? Auth::user()->province_code : '') }}';

            if (initialProvince) {
                // Populate districts based on the selected province
                populateDistricts(initialProvince);
            }

            // Update districts and wards on province change
            $('#province_code').change(function() {
                var province_code = $(this).val();
                populateDistricts(province_code);
            });

            // Load wards on district change
            $('#district_code').change(function() {
                var district_code = $(this).val();
                populateWards(district_code);
            });
        });
    </script>
@endsection
