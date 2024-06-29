@extends('client.layout.inheritance')

@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Checkout Page</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <!-- checkout-details-wrapper start -->
            <div class="checkout-details-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <!-- billing-details-wrap start -->
                        <div class="billing-details-wrap">
                            <form id="checkout-form" action="{{ route('order.save') }}" method="POST">
                                @csrf
                                <h3 class="shoping-checkboxt-title">Billing Details</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="single-form-row">
                                            <label>User name<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="user_name" id="user_name"
                                                value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                            <span class="placeholder" data-placeholder="Username"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="single-form-row">
                                            <label>Email <span class="required">*</span></label>
                                            <input type="text" name="user_email" id="user_email" class="form-control"
                                                value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                            <span class="placeholder" data-placeholder="Email"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="single-form-row">
                                            <label>Number phone <span class="required">*</span></label>
                                            <input type="text" name="user_phone" id="user_phone" class="form-control">
                                            <span class="placeholder" data-placeholder="Phone number"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="single-form-row">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" name="user_address" id="user_address"
                                                class="form-control">
                                            <span class="placeholder" data-placeholder="Address"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row m-0">
                                            <label>Order notes</label>
                                            <textarea placeholder="Notes about your order, e.g. special notes for delivery." class="checkout-mess" rows="2"
                                                cols="5"></textarea>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- billing-details-wrap end -->
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <!-- your-order-wrapper start -->
                        <div class="your-order-wrapper">
                            <h3 class="shoping-checkboxt-title">Your Order</h3>
                            <!-- your-order-wrap start-->
                            <div class="your-order-wrap">
                                <!-- your-order-table start -->
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
                                                            class="amount">${{ number_format($item['quantity_add'] * ($item['price'] ?: $item['price_sale']), 2) }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="shipping">
                                                <th>Shipping</th>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <input type="radio">
                                                            <label>Free Shipping:</label>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span
                                                            class="amount">${{ number_format($totalAmount, 2) }}</span></strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- your-order-table end -->

                                <!-- your-order-wrap end -->
                                <div class="payment-method">
                                    <div class="payment-accordion">
                                        <div class="form-check payment-content">
                                            <input type="radio" class="form-check-input bg-primary border-0"
                                                id="Delivery-1" name="payment_method" value="cod">
                                            <label class="form-check-label" for="Delivery-1">Thanh toán khi nhận
                                                hàng</label>
                                        </div>
                                        <div class="form-check payment-content">
                                            <input type="radio" id="vnpay-checkbox" class="form-check-input" name="payment_method" value="vnpay">
                                            <label class="form-check-label" for="vnpay-checkbox">Thanh toán VNPAY</label>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <form id="vnpay-form" action="{{ route('vnpay_payment') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="redirect" value="1">
                                            <button class="btn btn-default" type="submit">Thanh toán VNPAY</button>
                                        </form>
                                        <input type="submit" form="checkout-form" value="Place order"/>
                                    </div>
                                </div>
                                <!-- your-order-wrapper start -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- checkout-details-wrapper end -->
        </div>
    </div>
    <!-- content-wraper end -->
@endsection

@section('scripts')
    <script>
        fetch('ssvnpay_payment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    order_id: orderId // Thay orderId bằng giá trị thật của bạn
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    </script>
@endsection
