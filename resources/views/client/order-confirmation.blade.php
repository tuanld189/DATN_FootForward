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

        .checkout-box-left, .checkout-box-right {
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

        .customer-info {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
            padding: 20px;
        }

        .customer-info table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .customer-info th,
        .customer-info td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #e6e6e6;
            height: auto; /* Đổi chiều cao từ 40px thành auto */
            vertical-align: middle; /* Căn giữa nội dung */
        }

        .customer-info th {
            background-color: #f2f2f2;
            font-weight: bold;
            padding-left:25px;
            color: #333;
        }

        .customer-info .info-row {
            display: table-row;
        }

        .customer-info .info-row span {
            font-weight: bold;
            width: 120px;
            display: table-cell;
        }

        .customer-info .info-row p {
            display: table-cell;
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
                            <td>{{ number_format($item->product_sale_price ?: $item->product_price, 0, ',', '.') }} VNĐ</td>
                            <td>{{ number_format($item->quantity_add * ($item->product_sale_price ?: $item->product_price), 0, ',', '.') }} VNĐ</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="total_payment">
                            <td colspan="3"><span>Tổng tiền sản phẩm</span></td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                        </tr>
                        <tr>
                            <td colspan="3"><span>Phí vận chuyển</span></td>
                            <td>{{ number_format(50000, 0, ',', '.') }} VNĐ</td>
                        </tr>
                        <tr>
                            <td colspan="3"><span><b>Tổng cộng thanh toán</b></span></td>
                            <td><b>{{ number_format($order->total_price + 50000, 0, ',', '.') }} VNĐ</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="checkout-box-right ml-2 customer-info">
                <div class="order-title ">THÔNG TIN NGƯỜI ĐẶT HÀNG:</div>
                <div class="order-date">
               Cảm ơn bạn vì đã đặt hàng!
                </div>
                <table>
                    <tr class="info-row">
                        <th>Tên:</th>
                        <td>{{ $order->user_name }}</td>
                    </tr>
                    <tr class="info-row">
                        <th>Email:</th>
                        <td>{{ $order->user_email }}</td>
                    </tr>
                    <tr class="info-row">
                        <th>Điện thoại:</th>
                        <td>{{ $order->user_phone }}</td>
                    </tr>
                    <tr class="info-row">
                        <th>Địa chỉ:</th>
                        <td>{{ $order->user_address }}</td>
                    </tr>
                    @if ($order->user_note)
                    <tr class="info-row">
                        <th>Ghi chú:</th>
                        <td>{{ $order->user_note }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
    <div class="panel-foot mb-4 mt-3 ">
        <a href="{{ route('index') }}" class="btn btn-warning">Tiếp tục mua hàng</a>
    </div>
</div>
@endsection
