@extends('admin.layout.master')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <style>
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .order-item {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .order-item td {
            padding: 10px;
        }

        .order-item .image {
            width: 100px;
            height: auto;
        }

        .order-item-name {
            color: blue;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .order-item-price,
        .order-item-subtotal {
            text-align: right;
        }

        .order-item-qty {
            text-align: left;
        }

        .order-item-subtotal {
            font-weight: bold;
            color: black;
        }

        .order-aside {
            padding-left: 20px;
        }

        .edit {
            cursor: pointer;
            color: blue;
            font-weight: bold;
            font-size: 14px;
        }

        .page-title-box {
            margin-bottom: 20px;
        }

        .customer-line {
            margin-bottom: 10px;
        }

        .customer-line strong {
            margin-right: 5px;
        }

        .description {
            color: #666;
        }

        .ibox {
            margin-bottom: 20px;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Chi tiết đơn hàng</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-content">
                    <table class="order-table text-start">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                            <td>
                                <div class="order-item">
                                    <span></span> <img src="{{ Storage::url($item->product_image) }}"
                                        alt="Product Image" class="image">
                                </div>

                            </td>
                            <td>
                                <div class="mt-3">
                                    <span></span> {{ $item->product_name }}
                                </div>
                            </td>
                            <td>
                                <div class="mt-3">
                                    <span></span> {{ $item->quantity_add }}
                                </div>

                            </td>
                            <td>
                                <div class="mt-3">
                                    <span></span> ${{ number_format($item->product_price, 0) }}
                                </div>
                            </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-aside">
            <div class="ibox">
                <div class="ibox-title d-flex align-items-center justify-content-between">
                    <h5>Thông tin khách hàng</h5>
                    <div class="edit">Sửa</div>
                </div>
                <div class="ibox-content">
                    <div class="customer-line"><strong>N:</strong> {{ $order->user_name }}</div>
                    <div class="customer-line"><strong>E:</strong> {{ $order->user_email }}</div>
                    <div class="customer-line"><strong>P:</strong> {{ $order->user_phone }}</div>
                    <div class="customer-line"><strong>A:</strong> {{ $order->user_address }}</div>
                    <div class="customer-line"><strong>Trạng thái đơn hàng:</strong> {{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}</div>
                    <div class="customer-line"><strong>Trạng thái thanh toán:</strong> {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
