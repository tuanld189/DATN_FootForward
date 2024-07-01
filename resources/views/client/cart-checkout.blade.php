@extends('client.layout.inheritance')

@section('styles')
    <style>
        .payment-methods {
            display: flex;
            gap: 20px;
        }

        .payment-method {
            display: flex;
            align-items: center;
        }

        .payment-method label {
            margin-left: 8px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        .checkout-mess {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .cart-method label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .cart-method input[type="radio"] {
            margin-right: 10px;
        }

        .cart-checkout {
            display: block;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 0.25rem;
            transition: background-color 0.15s ease-in-out;
        }

        .cart-checkout:hover {
            background-color: #0056b3;
        }

        .cart-heading {
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .amount {
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="content-wraper mb-5">
        <div class="container">
            <div class="checkout-details-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="billing-details-wrap">
                            {{-- <form action="{{ route('order.place') }}" method="POST"> --}}
                            @csrf
                            <h3 class="shoping-checkboxt-title">Thông tin đặt hàng</h3>
                            <div class="row">
                                {{-- <div class="col-lg-6">
                                    <p class="single-form-row"> --}}
                                {{-- <label>User id<span class="required">*</span></label> --}}
                                <input type="hidden" class="form-control" name="user_id"
                                    value="{{ Auth::check() ? Auth::user()->id : '' }}">
                                {{-- <span class="placeholder" data-placeholder="Username"></span> --}}
                                {{-- </p>
                                </div> --}}
                                <div class="col-lg-6">
                                    <p class="single-form-row">
                                        <label>User name<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="user_name"
                                            placeholder="Nhập vào tên người dùng"
                                            value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                        <span class="placeholder" data-placeholder="Username"></span>
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="single-form-row">
                                        <label>Email <span class="required">*</span></label>
                                        <input type="text" name="user_email" placeholder="Nhập vào email"
                                            class="form-control" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                        <span class="placeholder" data-placeholder="Email"></span>
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="single-form-row">
                                        <label>Number phone <span class="required">*</span></label>
                                        <input type="text" name="user_phone" placeholder="Nhập vào số điện thoại"
                                            class="form-control">
                                        <span class="placeholder" data-placeholder="Phone number"></span>
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="single-form-row">
                                        <label>Address <span class="required">*</span></label>
                                        <input type="text" name="user_address" id="user_address" class="form-control">
                                        <span class="placeholder" data-placeholder="Address"></span>
                                    </p>
                                </div>
                                <div class="col-lg-12">
                                    <p class="single-form-row m-0">
                                        <label>Order notes</label>
                                        <textarea placeholder="Notes about your order, e.g. special notes for delivery." class="checkout-mess" rows="2"
                                            cols="5" name="user_note"></textarea>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="your-order-wrapper">
                            <h3 class="shoping-checkboxt-title">Giỏ hàng</h3>
                            <div class="your-order-wrap">
                                <div class="your-order-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product Name</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $item)
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        {{ $item['name'] }} <strong class="product-quantity"> ×
                                                            {{ $item['quantity_add'] }}</strong>
                                                    </td>
                                                    <td class="product-total">
                                                        <span
                                                            class="amount">{{ number_format($item['quantity_add'] * ($item['price'] ?: $item['price_sale'])) }}
                                                            VNĐ</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">{{ number_format($totalAmount, 0) }}
                                                            VNĐ</span></strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="coupon container m-4">
                                    @if (session('message'))
                                        <div class="alert alert-{{ session('status') }}">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <h4>Coupon</h4>
                                    <p>Enter your coupon code if you have one.</p>
                                    <form action="{{ route('cart.applyVoucher') }}" method="POST"
                                        class="flex justify-center">
                                        @csrf
                                        <input id="voucher_code" class="input-text" style="height: 38px;"
                                            name="voucher_code" value="" placeholder="Coupon code" type="text">
                                        <input class="btn btn-primary" value="Apply coupon" type="submit">
                                    </form>
                                </div>
                                <div class="panel-foot" style="margin-left: 35px">
                                    <h3 class="cart-heading"><span>Hình thức thanh toán</span></h3>
                                    <div class="cart-method">
                                        <label for="COD" class="uk-flex uk-flex-middle">
                                            <input type="radio" name="payment_method" value="COD" checked
                                                id="COD">
                                            <span class="title">Thanh toán khi nhân hàng</span>
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
                                <br>
                                <button type="submit" class=" cart-checkout btn btn-primary" value="create"
                                    name="create">Thanh toán đơn hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
                const paymentInfoText = document.querySelector('.payment-info-text');

                paymentMethods.forEach(method => {
                    method.addEventListener('change', function() {
                        if (this.value === 'bank_transfer') {
                            paymentInfoText.style.display = 'block';
                        } else {
                            paymentInfoText.style.display = 'none';
                        }
                    });
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form');

                form.addEventListener('submit', function() {
                    const submitButton = form.querySelector('button[type="submit"]');
                    submitButton.disabled = true;
                    submitButton.innerHTML = 'Đang xử lý...'; // Optional: Thay đổi text để thông báo đang xử lý
                });
            });
        </script>
    @endsection
