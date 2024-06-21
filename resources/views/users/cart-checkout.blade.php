@extends('users.layout.inheritance')

@section('style-list')
    <style>
        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }

        .order-column {
            width: 33.33%;
            text-align: center;
        }

        .order-column.product-name {
            text-align: left;
        }

        .order-column.product-quantity {
            text-align: center;
            margin-left:20px;
        }

        .order-column.product-price {
            text-align: right;
        }

        .order-header {
            font-weight: bold;
            border-bottom: 1px solid #e6e6e6;
            padding-bottom: 10px;
        }
        .coupon_area {
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Align buttons to the start */
        }

        .coupon_area input[type="text"] {
            flex: 1; /* Take up remaining space */
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #e6e6e6;
            border-radius: 5px;
            font-size: 14px;
            max-width: 200px; /* Limit input width */
        }

        .coupon_area .tp_btn {
            height: 45px;
            min-width: 100px; /* Minimum width for button */
            background: #f57224;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            text-align: center;
            padding: 0 10px; /* Adjust padding for better fit */
        }

        .coupon_area .tp_btn:hover {
            background: #e5641c;
        }

        .payment_item {
            margin-top: 20px;
        }

        .payment_item .radion_btn {
            display: flex;
            align-items: center;
        }

        .payment_item label {
            margin-left: 10px;
        }

        .payment_item img {
            max-width: 50px; /* Limit image width */
            margin-left: 10px;
        }

        .payment_item p {
            font-size: 14px;
            margin-top: 5px;
        }

        .text-center.pl-4 {
            margin-top: 20px; /* Add margin to bottom button */
        }

    </style>
@endsection

@section('content')
    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap mt-5">
        <div class="container">
            <div class="product_detail_row">
                <h3 class="product_detail_title">CART CHECKOUT</h3>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="billing_details">
                        <h3>Billing Details</h3>
                        <form class="contact_form" action="{{ route('users.order.save') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" name="user_name" id="user_name" >
                                <span class="placeholder" data-placeholder="Username"></span>

                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="text" name="user_phone" id="user_phone" class="form-control">
                                <span class="placeholder" data-placeholder="Phone number"></span>

                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="text" name="user_email" id="user_email" class="form-control"  >
                                <span class="placeholder" data-placeholder="Email"></span>
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="text" name="user_address" id="user_address" class="form-control">
                                <span class="placeholder" data-placeholder="Address"></span>

                            </div>

                            <div class="form-group">
                                <div class="creat_account">
                                    <label for="f-option2">
                                        <input type="checkbox" id="f-option2" name="create_account" checked>
                                        Create an account?
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="creat_account">
                                    <h3>Shipping Details</h3>
                                    <label for="f-option3">
                                        <input type="checkbox" id="f-option3" name="ship_to_different_address">
                                        Ship to a different address?
                                    </label>
                                </div>
                                <textarea class="form-control" name="user_note" id="user_note" rows="1" placeholder="Order Notes"></textarea>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li class="order-item order-header">
                                <div class="order-column product-name">Product Name</div>
                                <div class="order-column product-quantity">Quantity</div>
                                <div class="order-column product-price">Price</div>
                            </li>
                            @foreach($cart as $item)
                                <li class="order-item">
                                    <div class="order-column product-name">{{ $item['name'] }}</div>
                                    <div class="order-column product-quantity">x {{ $item['quantity_add'] }}</div>
                                    <div class="order-column product-price">${{ number_format($item['quantity_add'] * ($item['price'] ?: $item['price_sale']), 2) }}</div>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Total Amount <span>${{ number_format($totalAmount, 2) }}</span></a></li>
                            <li><a href="#">Shipping <span>Flat rate: $50.00</span></a></li>
                            <li><a href="#">Total <span>${{ number_format($totalAmount + 50, 2) }}</span></a></li>
                        </ul>
                        <div class="coupon_area">
                            <input type="text" placeholder="Enter coupon code">
                            <a class="tp_btn" href="#">Apply</a>
                        </div>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option5" name="payment_method" checked>
                                <label for="f-option5">Payment on delivery</label>
                                <div class="check"></div>
                            </div>
                        </div>
                        <div class="payment_item active">
                            <div class="radion_btn">
                                <input type="radio" id="f-option6" name="payment_method">
                                <label for="f-option6">Paypal </label>
                                <img src="img/product/card.jpg" alt="">
                                <div class="check"></div>
                            </div>
                            <p>You can pay with your credit card if you don’t have a PayPal account.</p>
                        </div>

                        <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="accept_terms" checked>
                            <label for="f-option4">I’ve read and accept the <a href="#">terms & conditions*</a></label>
                        </div>
                        <div class="text-center pl-4">
                            <button type="submit" class="btn primary-btn ml-3">CHECKOUT</button>
                        </div>
                    </div>
                </div>
            </form>

            </div>

        </div>
    </section>
@endsection

