@extends('client.layout.inheritance')

@section('style-list')
    <style>
        .panel-head {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }

        .panel-head h2 {
            color: #f57224; /* Màu sắc tiêu đề */
            font-weight: bold;
            font-size: 30px;
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
        }

        .panel-head a:hover {
            background-color: #e56613;
        }

        .checkout-box {
            border: 1px solid #ddd; /* Đổi sang màu sắc border mong muốn */
            border-radius: 5px;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Thêm độ bóng */
            display: flex;
            justify-content: space-between;
            margin-top: 20px; /* Thêm margin top cho khoảng cách */
        }

        .checkout-box-left, .checkout-box-right {
            width: 48%;
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
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
            width: 120px; /* Độ rộng của nhãn (label) */
            display: inline-block;
        }

        .info-row p {
            margin: 0;
            padding-left: 10px;
        }
    </style>
@endsection

@section('content')
    <section class="checkout_area section_gap mt-5">
        <div class="container">
            <div class="panel-head">
<h2 class="product_detail_title"><span>ĐẶT HÀNG THÀNH CÔNG </span></h2>
            </div>

            <div class="panel-body">
                <div class="checkout-box">
                    <div class="checkout-box-left">
                        <div class="order-title">
                            ĐƠN HÀNG
                        </div>
                        <div class="order-date">
                            Ngày đặt hàng: {{ $order->created_at->format('d-m-Y') }}
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá bán</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->quantity_add }}</td>
                                        <td>{{ number_format($item->product_price ?: $item->product_sale_price, 0) }} $</td>
                                        <td>{{ number_format($item->quantity_add * ($item->product_price ?: $item->product_sale_price), 0) }} $</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="total_payment">
                                    <td colspan="3"><span>Tổng tiền sản phẩm</span></td>
                                    <td>{{ number_format($order->total_price, 0) }} $</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><span>Phí vận chuyển</span></td>
                                    <td>{{ number_format(50, 0) }} $</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><span><b>Tổng cộng thanh toán</b></span></td>
                                    <td><b>{{ number_format($order->total_price + 50, 0) }} $</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="checkout-box-right ml-2">
                        <div class="customer-info">
                            <strong class="order-title text-center">THÔNG TIN NGƯỜI ĐẶT HÀNG:</strong>
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
                    </div>
                </div>
            </div>
            <div class="panel-foot mt-3">
                <a href="{{ route('index') }}">Tiếp tục mua hàng</a>
            </div>
        </div>
    </section>
@endsection
