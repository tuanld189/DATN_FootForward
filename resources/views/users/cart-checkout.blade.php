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
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="billing_details">
                        <h3>Billing Details</h3>
                        <form class="contact_form" action="{{ route('order.save') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="col-md-12 form-group p_star">
                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}">

                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" name="user_name" id="user_name" value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                <span class="placeholder" data-placeholder="Username"></span>

                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" name="user_email" id="user_email" class="form-control"  value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                <span class="placeholder" data-placeholder="Email"></span>
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="text" name="user_phone" id="user_phone" class="form-control" >
                                <span class="placeholder" data-placeholder="Phone number"></span>

                            </div>

                            <div class="col-md-12 form-group p_star">
                                <input type="text" name="user_address" id="user_address" class="form-control">
                                <span class="placeholder" data-placeholder="Address"></span>

                            </div>

                            <div class="province-district-ward">
                                <select name="city" id="city">
                                    <option value="">Tỉnh/Tp</option>
                                </select>
                                <select name="district" id="district">
                                    <option value="">Quận/Huyện</option>
                                </select>
                                <select name="ward" id="ward">
                                    <option value="">Phường/Xã</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="creat_account">
                                    <label for="f-option2">
                                        <input type="checkbox" id="f-option2" name="create_account" >
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
@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const provinceSelect = document.getElementById('province');
        const districtSelect = document.getElementById('district');
        const wardSelect = document.getElementById('ward');

        // Hàm để gọi API lấy danh sách tỉnh/thành phố
        async function fetchProvinces() {
            const response = await fetch('https://provinces.open-api.vn/api/p/');
            const data = await response.json();
            return data;
        }

        // Hàm để gọi API lấy danh sách quận/huyện dựa vào tỉnh/thành phố
        async function fetchDistricts(provinceCode) {
            const response = await fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`);
            const data = await response.json();
            return data.districts;
        }

        // Hàm để gọi API lấy danh sách xã/phường dựa vào quận/huyện
        async function fetchWards(districtCode) {
            const response = await fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`);
            const data = await response.json();
            return data.wards;
        }

        // Hàm để điền dữ liệu vào select
        function populateSelect(select, options, labelKey, valueKey) {
            select.innerHTML = '<option value="">Chọn</option>';
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option[valueKey];
                optionElement.textContent = option[labelKey];
                select.appendChild(optionElement);
            });
        }

        // Khi người dùng chọn tỉnh/thành phố
        provinceSelect.addEventListener('change', async function() {
            const provinceCode = this.value;
            if (provinceCode) {
                const districts = await fetchDistricts(provinceCode);
                populateSelect(districtSelect, districts, 'name', 'code');
                wardSelect.innerHTML = '<option value="">Chọn Xã/Phường</option>';
            } else {
                districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
                wardSelect.innerHTML = '<option value="">Chọn Xã/Phường</option>';
            }
        });

        // Khi người dùng chọn quận/huyện
        districtSelect.addEventListener('change', async function() {
            const districtCode = this.value;
            if (districtCode) {
                const wards = await fetchWards(districtCode);
                populateSelect(wardSelect, wards, 'name', 'code');
            } else {
                wardSelect.innerHTML = '<option value="">Chọn Xã/Phường</option>';
            }
        });

        // Khởi tạo danh sách tỉnh/thành phố khi trang được tải
        fetchProvinces().then(provinces => {
            populateSelect(provinceSelect, provinces, 'name', 'code');
        });
    });
</script>
@endsection
