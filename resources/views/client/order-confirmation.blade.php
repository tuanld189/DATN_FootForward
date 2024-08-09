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



        .table {
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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


        .order-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); Thêm shadow nếu cần */
            border-radius: 5px; /* Tạo góc bo tròn */
            
        }

        .order-date,
        .order-code {
            font-weight: bold; /* Làm chữ đậm */
        }

        .icon-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px; /* Khoảng cách giữa icon và chữ cảm ơn */
        }

        .icon-checkmark {
            background-color: #8a8f6a; /* Màu nền của hình tròn */
            color: white; /* Màu chữ V */
            border-radius: 50%; /* Hình tròn */
            width: 150px; /* Kích thước icon */
            height: 150px; /* Kích thước icon */
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 128px; /* Kích thước chữ V */
            font-weight: bold;
        }
        .panel-head {
            display: flex;
            flex-direction: column; /* Sắp xếp các phần tử theo chiều dọc */
            align-items: center; /* Canh giữa các phần tử theo chiều ngang */
            text-align: center; /* Căn giữa văn bản */
            background-color: white;
            margin:0;
            padding: 0;
        }

        .icon-container {
            margin-bottom: 10px; /* Khoảng cách giữa biểu tượng và văn bản */
        }

        .product_detail_title {
            font-size: 24px; /* Kích thước của tiêu đề */
            margin: 0; /* Loại bỏ khoảng cách mặc định của tiêu đề */
        }


        .checkout-box {
            display: flex;
            justify-content: space-between;
            padding: 0;
            background-color: while;
            margin: 20px;
            border-radius: 5px;
        }

        .customer-info {
            flex: 1;
            margin-right: 20px;
        }

        .order-status {
            flex: 1;
        }

        .order-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .order-date {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .info-row {
            margin-bottom: 10px;
        }

        .info-row span {
            font-weight: bold;
        }

        .info-row p {
            margin: 0;
        }

        .badge {
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 4px;
            display: inline-block;
        }

        .bg-success { background-color: #28a745; }
        .bg-danger { background-color: #dc3545; }
        .bg-warning { background-color: #ffc107; }
        .bg-info { background-color: #17a2b8; }
        .bg-primary { background-color: #007bff; }
        .bg-secondary { background-color: #6c757d; }

        .text-white { color: #fff; }
        .text-dark { color: #343a40; }

    </style>
@endsection

@section('content')
    <div class="container" >
        <div class="panel-body">   
            <div style="border: 1px solid white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding:20px;">
                
                <div class="panel-head">
                    <div class="panel-head">
                        <div class="icon-container">
                            <div class="icon-checkmark">✓</div>
                        </div>
                        <div class="text-container pt-3">
                            <h2 class="product_detail_title"><span>Cảm ơn bạn đã đặt hàng</span></h2>
                        </div>
                    </div>
                </div>
                <div class="checkout-box">
                    <div class="customer-info">
                        <div class="order-title">THÔNG TIN NGƯỜI ĐẶT HÀNG:</div>
                        <div class="info-row ">
                            <span>Tên:</span>
                            <p>{{ $order->user_name }}</p>
                        </div>
                        
                        <div class="info-row">
                            <span>Email:</span>
                            <p>{{ $order->user_email }}</p>
                        </div>
                        
                        <div class="info-row">
                            <span>Điện thoại:</span>
                            <p>{{ $order->user_phone }}</p>
                        </div>
                        
                        <div class="info-row">
                            <span>Địa chỉ:</span>
                            <p>{{ $order->user_address }}</p>
                        </div>
                        
                        @if ($order->user_note)
                            <div class="info-row">
                                <span>Ghi chú:</span>
                                <p>{{ $order->user_note }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="order-status" style="margin:40px 20px 20px;">
                        <div class="order-title">THÔNG TIN ĐƠN HÀNG:</div>
                        <div class="" style="margin:10px 0">
                            <span style="font-weight: bold;">Mã đơn hàng:</span> 
                            {{ $order->order_code }}
                        </div>
                        <div style="margin:10px 0">
                            <span style="font-weight: bold;">Ngày đặt hàng:</span> 
                            {{ $order->created_at->format('d-m-Y') }}
                        </div>
                        <div style="margin:10px 0">
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
                            <span style="font-weight: bold;">Tình trạng thanh toán:</span> <span class="badge {{ $paymentClasses[$order->status_payment] }} text-uppercase">
                                {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}
                            </span>
                        </div>
                        <div style="margin:10px 0">
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
                            <span style="font-weight: bold;">Tình trạng đơn hàng  :</span> <span class="badge {{ $statusClasses[$order->status_order] }} text-uppercase">
                                {{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="checkout-box-left">
                    <table class="table table-striped table-hover shadow">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá bán</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' .  $item->product_image ) }}" alt="" class="img-fluid" style="max-width: 70px;">
                                    </td>
                                    <td>{{ $item->quantity_add }}</td>
                                    <td>{{ number_format($item->product_sale_price ?: $item->product_price, 0, ',', '.') }} VNĐ</td>
                                    <td>{{ number_format($item->quantity_add * ($item->product_sale_price ?: $item->product_price), 0, ',', '.') }} VNĐ</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
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
                                    <td><span class="amount">-{{ number_format(session('discount'), 0, ',', '.') }} VNĐ</span></td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="4"><span>Phí vận chuyển</span></td>
                                <td>{{ number_format(0, 0, ',', '.') }} VNĐ</td>
                            </tr>
                            <tr>
                                <td colspan="4"><span><b>Tổng cộng thanh toán</b></span></td>
                                <td><b>{{ number_format($order->total_price + 0, 0, ',', '.') }} VNĐ</b></td>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
                <div class=" mt-3 text-center" >
                        <a href="{{ route('index') }}" class="btn btn-warning" style="border-radius: 10px;">Tiếp tục mua hàng</a>
                </div>                   
                
            </div>

        </div>

        
    </div>
@endsection

@section('scripts')
<script>

</script>
@endsection
