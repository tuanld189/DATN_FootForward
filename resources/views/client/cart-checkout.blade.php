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
@endsection

@section('content')
    <div class="content-wraper mb-5">
        <div class="container">
            <!-- Breadcrumb và tiêu đề -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Home</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Cart</li>
                                <li class="breadcrumb-item active">Checkout</li>
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
                                <div class="row">
                                    <!-- Thông tin người dùng -->
                                    <div class="col-12">
                                        <p class="single-form-row">
                                            <label>User name<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="user_name"
                                                placeholder="Nhập vào tên người dùng"
                                                value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p class="single-form-row">
                                            <label>Email <span class="required">*</span></label>
                                            <input type="text" name="user_email" placeholder="Nhập vào email"
                                                class="form-control" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p class="single-form-row">
                                            <label>Number phone <span class="required">*</span></label>
                                            <input type="number" name="user_phone" placeholder="Nhập vào số điện thoại"
                                                value="0904143512" class="form-control">
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p class="single-form-row">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" name="user_address" id="user_address" class="form-control"
                                                value="HH, HN ">
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p class="single-form-row m-0">
                                            <label>Order notes</label>
                                            <textarea placeholder="Notes about your order, e.g. special notes for delivery." class="checkout-mess" rows="2"
                                                cols="5" name="user_note"></textarea>
                                        </p>
                                    </div>
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
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product Name</th>
                                                <th class="product-name">Price</th>
                                                <th class="product-name">Total</th>
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
                                                    <th><b>Giảm giá</b></th>
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
                                                        {{-- <span class="amount"
                                                            id="total-payment-amount">{{ number_format($totalAmount - $discount, 0, ',', '.') }}
                                                            VNĐ</span> --}}
                                                        <span class="amount"
                                                            id="total-payment-amount">{{ number_format($totalAmount, 0, ',', '.') }}
                                                            VNĐ</span>
                                                    </strong>
                                                </td>
                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>

                                <!-- Nhập mã giảm giá -->
                                {{-- <div class="coupon-container d-flex flex-column align-items-center m-2"> --}}
                                <div class="coupon-container m-4">
                                    @if (session('message'))
                                        <div class="alert alert-{{ session('status') }} mb-2">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <h4>Coupon</h4>
                                    <form action="{{ route('cart.applyVoucher') }}" method="POST"
                                        class="d-flex flex-column">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <input id="voucher_code" class="input-text form-control w-100 no-border-corners"
                                                style="height: 38px;" name="voucher_code" value=""
                                                placeholder="Coupon code" type="text">
                                        </div>
                                        <button class="btn btn-primary w-100" type="submit">Apply coupon</button>
                                    </form>
                                </div>

                                {{-- <div class="coupon-container m-4">
                                    @if (session('message'))
                                        <div class="alert alert-{{ session('status') }} mb-2" id="coupon-message">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <h4 class="coupon-title">Coupon</h4>
                                    <form id="coupon-form" action="{{ route('cart.applyVoucher') }}" method="POST"
                                        class="coupon-form">
                                        @csrf
                                        <div class="form-group">
                                            <input id="voucher_code" class="input-text form-control" name="voucher_code"
                                                value="" placeholder="Enter your coupon code" type="text">
                                        </div>
                                        <button class="btn btn-primary w-100" type="submit">Apply coupon</button>
                                    </form>
                                    <div id="ajax-message" class="mt-3"></div>
                                </div> --}}



                                <!-- Phần thanh toán -->
                                {{-- <div class="panel-foot d-flex flex-column align-items-center m-2 p-2" style="margin-left: 35px"> --}}
                                <div class="panel-foot  p-2" style="margin-left: 35px">
                                    <h3 class="cart-heading"><span>Hình thức thanh toán</span></h3>
                                    <div class="cart-method">
                                        <label for="COD" class="uk-flex uk-flex-middle">
                                            <input type="radio" name="payment_method" value="COD" checked
                                                id="COD">
                                            <span class="title">Thanh toán khi nhận hàng</span>
                                        </label>
                                    </div>
                                    <div class="cart-method">
                                        <label for="vnpay" class="uk-flex uk-flex-middle">
                                            <input type="radio" name="payment_method" value="vnpay" id="vnpay">
                                            <span class="title">Thanh toán bằng VNPAY</span>
                                        </label>
                                    </div>
                                    <div class="cart-method">
                                        <label for="momo" class="uk-flex uk-flex-middle">
                                            <input type="radio" name="payment_method" value="momo" id="momo">
                                            <span class="title">Thanh toán bằng MOMO</span>
                                        </label>
                                    </div>
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
  
@endsection
