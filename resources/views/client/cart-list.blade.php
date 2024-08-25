@extends('client.layouts.master')

@section('styles')
    <style>
        .plantmore-product-quantity input.qty {
            width: 50px;
            height: 40px;
            text-align: center;
            display: inline-block;
            margin: 0 auto;
            box-sizing: border-box;
            border: 1px solid #ccc;

        }

        .plantmore-product-quantity .quantity-buttons {
            display: inline-flex;
            vertical-align: middle;
        }

        .quantity-buttons button {
            color:while;
            border: 1px solid #ccc;
            background-color: #8a8f6a;
            padding: 5px 10px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

        }

        .quantity-buttons button:hover {
            background-color: #000;
        }

        .old-price {
            text-decoration: line-through;
        }

        .cart-table {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            margin: 0 -25px 0;
        }

        .page-title-box {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .page-title-box h4 {
            margin: 0;
        }

        .page-title-right {
            display: flex;
            align-items: center;
        }

        .page-title-right ol.breadcrumb {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .page-title-right ol.breadcrumb li {
            display: inline;
            margin-right: 5px;
        }

        .page-title-right ol.breadcrumb li a {
            color: #007bff;
            text-decoration: none;
        }

        .page-title-right ol.breadcrumb li.active {
            color: #6c757d;
        }

        .page-title-right ol.breadcrumb li::after {
            content: '>';
            margin-left: 5px;
            color: #6c757d;
        }

        .page-title-right ol.breadcrumb li:last-child::after {
            content: '';
            margin-left: 0;
        }

        .continue-btn, .proceed-checkout-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .continue-btn:hover, .proceed-checkout-btn:hover {
            background-color: #0056b3;
        }

        .cart-page-total {

            padding: 20px;
            border-radius: 10px;
            background-color: #fff;

        }

        .cart-page-total h2 {
            margin-top: 0;
        }

        .cart-page-total ul {
            list-style: none;
            padding: 0;
        }

        .cart-page-total ul li {
            font-size: 16px;

        }

        .cart-page-total ul li span {
            font-weight: bold;
        }
        .cart-page-total .proceed-checkout-btn{
            background-color: #8a8f6a
        }
        .cart-page-total .proceed-checkout-btn:hover{
            background-color: #000;
        }
        .cart-table .coupon-all .coupon2 .continue-btn{
            background-color: #8a8f6a
        }
        .cart-table .coupon-all .coupon2 .continue-btn:hover{
            background-color: #000;
        }


        .table {
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-content table {
            border:1px solid #8a8f6a;
            border-radius: 5px;
        }

        .table img {
            border-radius: 5px;
        }

        .table thead th {
            background-color: #8a8f6a;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table tfoot td {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .table .amount {
            color: red;
        }
    </style>
@endsection

@section('content')
    <!-- breadcrumb-area end -->

    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <h4 class="mb-sm-0">Chi tiết đơn hàng</h4>
                        <div class="page-title-right ">
                            <ol class="breadcrumb m-0 ">
                                <li class="m-1"><a href="javascript: void(0);">Trang chủ ></a></li>
                                <li class="active m-1"> Giỏ hàng ></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cart-table">
                        <div class="table-content table-responsive">
                            <table class="table table-striped table-hover shadow">
                                <thead class="thead-dark">
                                    <tr>

                                        <th class="plantmore-product-thumbnail">Ảnh</th>
                                        <th class="cart-product-name">Tên</th>
                                        <th class="cart-product-color">Màu sắc</th>
                                        <th class="cart-product-size">Kích cỡ</th>
                                        <th class="plantmore-product-price">Đơn giá</th>
                                        <th class="plantmore-product-quantity">Số lượng</th>
                                        <th class="plantmore-product-subtotal">Tổng cộng</th>
                                        <th class="plantmore-product-remove">Xóa đơn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalAmount = 0; @endphp
                                    @forelse(session('cart', []) as $item)
                                        @php
                                            $itemTotal = $item['quantity_add'] * ($item['sale_price'] ?: $item['price']);
                                            $totalAmount += $itemTotal;
                                        @endphp
                                        <tr>
                                            <td class="plantmore-product-thumbnail">
                                                <a href="#">
                                                    <img src="{{ $item['image'] }}" alt="" width="70px">
                                                </a>
                                            </td>
                                            <td class="plantmore-product-name"><a href="#">{{ $item['name'] }}</a></td>
                                            <td class="plantmore-product-color">{{ $item['color']['name'] }}</td>
                                            <td class="plantmore-product-size">{{ $item['size']['name'] }}</td>
                                            <td class="plantmore-product-price">
                                                @if ($item['sale_price'])
                                                    <span class="amount old-price">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</span>
                                                    <span class="amount new-price">{{ number_format($item['sale_price'], 0, ',', '.') }} VNĐ</span>
                                                @else
                                                    <span class="amount">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</span>
                                                @endif
                                            </td>
                                            <td class="plantmore-product-quantity product_count">
                                                <form action="{{ route('cart.update', ['id' => $item['id']]) }}" method="POST">
                                                    @csrf
                                                    <div class="quantity-buttons">
                                                        <button type="button" onclick="changeQuantity('{{ $item['id'] }}', -1)" style="color: white;">-</button>
                                                        <input type="number" name="quantity_add" id="sst-{{ $item['id'] }}" value="{{ $item['quantity_add'] }}" title="Số lượng:" class="input-text qty" min="1" onchange="this.form.submit()">
                                                        <button type="button" onclick="changeQuantity('{{ $item['id'] }}', 1)" style="color: white;">+</button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="product-subtotal">
                                                @if ($item['sale_price'])
                                                    <span class="amount old-price" id="total-{{ $item['id'] }}" >{{ number_format($item['price'] * $item['quantity_add'] , 0, ',', '.') }} VNĐ</span>
                                                    <span class="amount new-price" id="total-{{ $item['id'] }}" data-price="{{ $item['sale_price'] ?: $item['price'] }}">{{ number_format($itemTotal, 0, ',', '.') }} VNĐ</span>
                                                @else
                                                <span class="amount" id="total-{{ $item['id'] }}" >{{ number_format($item['price'] * $item['quantity_add'] , 0, ',', '.') }} VNĐ</span>
                                                @endif
                                            </td>
                                            <td class="plantmore-product-remove">
                                                <form action="{{ route('cart.remove', ['id' => $item['id']]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="remove-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="fa fa-times"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">Không có sản phẩm nào trong giỏ hàng</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="coupon-all">
                                    <div class="coupon2">
                                        <a href="{{ route('index') }}" class="btn continue-btn">Tiếp tục mua sắm</a>
                                    </div>
                                    {{-- <div class="coupon-container">
                                        @if (session('message'))
                                            <div class="alert alert-{{ session('status') }}">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                        <h4>Coupon</h4>
                                        <p>Enter your coupon code if you have one.</p>
                                        <form action="{{ route('cart.applyVoucher') }}" method="POST">
                                            @csrf
                                            <input id="voucher_code" class="input-text" style="height: 38px;" name="voucher_code" value="" placeholder="Coupon code" type="text">
                                            <button class="btn btn-primary" type="submit">Apply coupon</button>
                                        </form>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-md-4 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Tổng đơn hàng</h2>
                                    <ul>
                                        <li>Tổng cộng <span>{{ number_format($totalAmount) }} VNĐ</span></li>
                                    </ul>
                                    <a href="{{ route('cart.checkout') }}" class="proceed-checkout-btn">Tiếp tục thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#coupon-form').on('submit', function(e) {
                e.preventDefault(); // Ngăn chặn gửi form mặc định

                $.ajax({
                    url: '{{ route('cart.applyVoucher') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            $('.coupon-container').prepend('<div class="alert alert-success">' + response.message + '</div>');
                        } else {
                            $('.coupon-container').prepend('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        $('.coupon-container').prepend('<div class="alert alert-danger">Đã xảy ra lỗi</div>');
                    }
                });
            });
        });

        function changeQuantity(id, change) {
            var input = document.getElementById('sst-' + id);
            var quantity = parseInt(input.value);
            quantity += change;
            if (quantity < 1) {
                quantity = 1;
            }
            input.value = quantity;
            input.dispatchEvent(new Event('change'));
        }

        function updateCart() {
            var cartItems = [];
            var cartRows = document.querySelectorAll('tbody tr');
            cartRows.forEach(function(row) {
                var id = row.querySelector('input.qty').getAttribute('id').replace('sst-', '');
                var quantity = parseInt(row.querySelector('input.qty').value);
                cartItems.push({ id: id, quantity_add: quantity });
            });

            fetch('{{ route('cart.update-multiple') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ updated_cart: cartItems })
                })
                .then(response => {
                    if (response.ok) return response.json();
                    throw new Error('Network response was not ok.');
                })
                .then(data => {
                    if (data.success) {
                        alert('Cập nhật giỏ hàng thành công!');
                        location.reload();
                    } else {
                        alert('Cập nhật giỏ hàng thất bại.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function updatetotalAmount() {
            var totalAmounts = document.querySelectorAll('.product-subtotal span');
            var total = 0;
            totalAmounts.forEach(function(totalAmount) {
                var price = parseFloat(totalAmount.dataset.price);
                var quantity = parseInt(totalAmount.closest('tr').querySelector('input.qty').value);
                total += price * quantity;
            });
            document.querySelector('.cart-page-total li span').textContent = number_format(total) + ' VNĐ';
        }

        document.querySelectorAll('input.qty').forEach(function(input) {
            input.addEventListener('change', function() {
                updatetotalAmount();
            });
        });
    </script>
@endsection
