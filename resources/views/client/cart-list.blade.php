@extends('client.layouts.master')

@section('styles')
    <style>
        .plantmore-product-quantity input.qty {
            width: 60px;
            height: 30px;
            text-align: center;
            display: inline-block;
            margin: 0 auto;
            box-sizing: border-box;
        }

        .old-price {
            text-decoration: line-through;
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
                                <li class="active m-1"> chi tiết giỏ hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cart-table">
                        <div class="table-content table-responsive">
                            <table class="table table-hover">
                                <thead>
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
                                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="" width="70px">
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
                                                    <input type="number" name="quantity_add" id="sst-{{ $item['id'] }}" value="{{ $item['quantity_add'] }}" title="Quantity:" class="input-text qty" min="1" onchange="this.form.submit()">
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
                                                    <button type="submit" class="remove-btn" onclick="return confirm('Are you sure?')"><i class="fa fa-times"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">No items in the cart</td>
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
                        $('.coupon-container').prepend('<div class="alert alert-danger">An error occurred</div>');
                    }
                });
            });
        });

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
                        alert('Cart updated successfully!');
                        location.reload();
                    } else {
                        alert('Failed to update cart.');
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
