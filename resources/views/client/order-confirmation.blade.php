@extends('client.layouts.master')
@section('title', 'Xác nhận')
@section('styles')
    <style>
        .panel-head {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
        }

        .panel-head h2 {
            color: #f57224;
            font-weight: bold;
            font-size: 30px;
            margin: 0;
        }

        .panel-foot {
            text-align: center;
            margin-top: 20px;
        }

        .panel-foot a {
            color: #f57224;
            text-decoration: none;
            font-size: 16px;
            background-color: #f57224;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            float: right;
        }

        .checkout-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .checkout-box-left,
        .checkout-box-right {
            padding: 20px;
        }

        .order-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .order-date {
            color: #888;
            font-size: 14px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #e6e6e6;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }

        .total_payment {
            font-weight: bold;
            color: #333;
        }

        .total_payment td {
            border-top: 1px solid #e6e6e6;
        }

        .total_payment span {
            font-weight: normal;
        }

        .customer-info {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
            padding: 20px;
        }

        .customer-info strong {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            margin-top: 10px;
        }

        .info-row span {
            font-weight: bold;
            width: 120px;
            display: inline-block;
        }

        .info-row p {
            margin: 0;
            padding-left: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="panel-head">
            <h2 class="product_detail_title"><span>ĐẶT HÀNG THÀNH CÔNG</span></h2>
        </div>

        <div class="panel-body">
            <div style="border:1px solid rgb(209, 208, 208); padding:20px;">
                <div class="checkout-box-left">
                    <div class="order-title">
                        ĐƠN HÀNG
                    </div>
                    <div class="order-date">
                        Ngày đặt hàng: {{ $order->created_at->format('d-m-Y') }} <br>
                        Mã đơn hàng: {{ $order->order_code }}
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh</th>
                                <th>Số lượng</th>
                                <th>Giá bán</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' .  $item->product_image ) }}" alt="" width="70px">
                                    </td>
                                    <td>{{ $item->quantity_add }}</td>
                                    <td>{{ number_format($item->product_sale_price ?: $item->product_price, 0, ',', '.') }}
                                        VNĐ</td>
                                    <td>{{ number_format($item->quantity_add * ($item->product_sale_price ?: $item->product_price), 0, ',', '.') }}
                                        VNĐ</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            {{-- <span class="amount"
                                id="total-order-amount">{{ number_format($totalAmount + $discount, 0, ',', '.') }}
                                VNĐ</span> --}}


                            {{-- <tr class="total_payment">
                                <td colspan="3"><span>Tổng tiền sản phẩm</span></td>

                                <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                            </tr> --}}

                            <tr>
                                <td colspan="4"><span><b>Tổng tiền sản phẩm</b></span></td>
                                <td><b>
                                    @php
                                        $discount = session('discount', 0);
                                        $totalPrice = $order->total_price;
                                        $shippingFee = 0; // Adjust as needed
                                        $totalPayable = $totalPrice + $discount;
                                    @endphp
                                    {{ number_format($totalPayable, 0, ',', '.') }} VNĐ
                                </b></td>
                            </tr>

                            @if (session('discount') > 0)
                                <tr class="total_payment">
                                    <td colspan="4"><span>Mã giảm giá</span></td>
                                    <td><span class="amount">-{{ number_format(session('discount'), 0, ',', '.') }}
                                            VNĐ</span></td>
                                </tr>
                            @endif
                            <tr>
                                {{-- <td colspan="4"><span>Phí vận chuyển</span></td>
                                <td>{{ number_format(0, 0, ',', '.') }} VNĐ</td> --}}
                            </tr>
                            <tr>
                                <td colspan="4"><span><b>Tổng cộng thanh toán</b></span></td>
                                {{-- <td><b>{{ number_format($order->total_price + 50000, 0, ',', '.') }} VNĐ</b></td> --}}
                                <td><b>{{ number_format($order->total_price + 0, 0, ',', '.') }} VNĐ</b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="checkout-box-right ml-2">

                    <div class="order-title ">THÔNG TIN NGƯỜI ĐẶT HÀNG:</div>
                    <div class="order-date">
                        Cảm ơn bạn vì đã đặt hàng!
                    </div>
                    <div class="info-row mt-5">
                        <span>Tên:</span>
                        <p>{{ $order->user_name }}</p>
                    </div>
                    <hr>
                    <div class="info-row">
                        <span>Email:</span>
                        <p>{{ $order->user_email }}</p>
                    </div>
                    <hr>
                    <div class="info-row">
                        <span>Điện thoại:</span>
                        <p>{{ $order->user_phone }}</p>
                    </div>
                    <hr>
                    <div class="info-row">
                        <span>Địa chỉ:</span>
                        <p>{{ $order->user_address }}</p>
                    </div>
                    <hr>
                    @if ($order->user_note)
                        <div class="info-row">
                            <span>Ghi chú:</span>
                            <p>{{ $order->user_note }}</p>
                        </div>
                    @endif

                </div>
                <div style="padding-left:20px;">
                    <div>
                        @php
                            $paymentIcons = [
                                'paid' => 'fas fa-check-circle',
                                'unpaid' => 'fas fa-times-circle',
                                'pending' => 'fas fa-clock',
                            ];

                            $paymentClasses = [
                                'paid' => 'bg-success text-white',
                                'unpaid' => 'bg-danger text-white',
                                'pending' => 'bg-warning text-dark',
                            ];

                        @endphp
                        Tình trạng thanh toán: <span class="badge {{ $paymentClasses[$order->status_payment] }} text-uppercase">

                            {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}
                        </span>
                    </div>
                    <div>
                        @php
                           $statusIcons = [
                                'pending' => 'fas fa-hourglass-start',
                                'confirmed' => 'fas fa-check-circle',
                                'preparing_goods' => 'fas fa-cogs',
                                'shipping' => 'fas fa-truck',
                                'delivered' => 'fas fa-box-open',
                                'canceled' => 'fas fa-times-circle',
                            ];

                            $statusClasses = [
                                'pending' => 'bg-warning text-dark',
                                'confirmed' => 'bg-success text-white',
                                'preparing_goods' => 'bg-info text-white',
                                'shipping' => 'bg-primary text-white',
                                'delivered' => 'bg-secondary text-white',
                                'canceled' => 'bg-danger text-white',
                            ];
                        @endphp
                        Tình trạng đơn hàng: <span class="badge {{ $statusClasses[$order->status_order] }} text-uppercase">
                            {{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}
                        </span>
                    </div>
                </div>
            </div>

        </div>

        <div class="panel-foot mt-3">
            <a href="{{ route('index') }}" class="btn btn-warning">Tiếp tục mua hàng</a>
        </div>
    </div>
@endsection

@section('scripts')
<script>

</script>
@endsection
