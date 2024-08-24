@extends('client.layouts.master')
{{-- @include('client.layouts.header') --}}

@section('title', 'Trang chủ')

@section('styles')
    <style>
        /* Search Form Styling */
        .search-form {
            display: flex;
            align-items: center;
            max-width: 300px;
            margin: 20px auto;
            border: 2px solid #8a8f6a;
            border-radius: 25px;
            overflow: hidden;
            background-color: #f9f9f9;
        }

        /* Input Field Styling */
        .search-input {
            flex: 1;
            padding: 8px 12px;
            border: none;
            outline: none;
            font-size: 14px;
            border-radius: 25px 0 0 25px;
            background-color: transparent;
            color: #8a8f6a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Button Styling */
        .search-button {
            padding: 8px 15px;
            border: none;
            background-color: #8a8f6a;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            border-radius: 0 25px 25px 0;
            transition: background-color 0.3s ease;
            white-space: nowrap;
        }

        .search-button:hover {
            background-color: #6f7354;
        }

        /* Placeholder Text Styling */
        .search-input::placeholder {
            color: #8a8f6a;
        }

        /* Modal Styling */
        .modal {
            display: block;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 10px;
            position: relative;
        }

        .close-button {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Table Styling */
        .order-table,
        .order-items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .order-table th,
        .order-items-table th {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: left;
        }

        .order-table td,
        .order-items-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .order-items-table img {
            max-width: 70px;
        }

        .not-found-message {
            text-align: center;
            color: #8a8f6a;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <form class="search-form" action="{{ route('searchOrder') }}" method="GET">
            <input type="text" name="search" class="search-input" placeholder="Nhập mã đơn hàng, email, điện thoại hoặc tên"
                value="{{ request('search') }}">
            <button type="submit" class="search-button">Tìm kiếm</button>
        </form>

        @if (request()->filled('search') && $orders->isNotEmpty())
            <div id="order-search-result" class="modal">
                <div class="modal-content">
                    <span class="close-button" onclick="closeModal()">&times;</span>
                    <h3>Kết quả tìm kiếm đơn hàng</h3>
                    @foreach ($orders as $order)
                        <h4>Thông tin đơn hàng: {{ $order->order_code }}</h4>
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Email</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái đơn hàng</th>
                                    <th>Trạng thái thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->order_code }}</td>
                                    <td>{{ $order->user_email }}</td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td>{{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}</td>
                                    <td>{{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <h4>Chi tiết sản phẩm</h4>
                        <table class="order-items-table">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá bán</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $item->product_image) }}" alt="Ảnh sản phẩm">
                                        </td>
                                        <td>{{ $item->quantity_add }}</td>
                                        <td>{{ number_format($item->product_sale_price ?: $item->product_price, 0, ',', '.') }}
                                            VNĐ
                                        </td>
                                        <td>{{ number_format($item->quantity_add * ($item->product_sale_price ?: $item->product_price), 0, ',', '.') }}
                                            VNĐ
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        @elseif(request()->filled('search'))
            {{-- <p>Không tìm thấy đơn hàng nào hoặc mã đơn không đúng.</p> --}}
            <p class="not-found-message">Không tìm thấy đơn hàng nào hoặc mã đơn không đúng.</p>

        @endif
        {{-- @if (auth()->check() && request('search'))
            <h3>Kết quả tìm kiếm đơn hàng:</h3>
            @if ($orders->isNotEmpty())
                <table>
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Email</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Trạng thái thanh toán</th>
                            <!-- Thêm các cột khác nếu cần -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->user_email }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->status_order }}</td>
                                <td>{{ $order->status_payment }}</td>
                                <!-- Hiển thị các thông tin khác của đơn hàng -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Không tìm thấy đơn hàng nào.</p>
            @endif
        @endif --}}
    </div>
@endsection

@section('scripts')
    <script>
        function closeModal() {
            document.getElementById('order-search-result').style.display = 'none';
        }
    </script>
@endsection

{{-- @include('client.layouts.footer') --}}
