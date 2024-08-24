@extends('client.layouts.master')
@section('title', 'Tìm kiếm đơn hàng')

@section('content')
    <div class="search-container">
        <form action="{{ route('orders.search') }}" method="GET">
            <input type="text" name="search" placeholder="Nhập mã đơn hàng, email hoặc số điện thoại..." value="{{ request('search') }}">
            <button type="submit">Tìm kiếm</button>
        </form>
    </div>

    @if(request()->filled('search'))
        <h3>Kết quả tìm kiếm đơn hàng:</h3>
        @if($orders->isNotEmpty())
            <div class="order-results">
                @foreach ($orders as $order)
                    <div class="order-card">
                        <h4>Mã đơn hàng: {{ $order->order_code }}</h4>
                        <p>Ngày đặt hàng: {{ $order->created_at->format('d-m-Y') }}</p>
                        <p>Khách hàng: {{ $order->user->name ?? 'N/A' }}</p>
                        <p>Email: {{ $order->user_email }}</p>
                        <p>Điện thoại: {{ $order->user_phone }}</p>
                        <p>Tổng giá trị: {{ number_format($order->total_price, 0, ',', '.') }} VND</p>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                @endforeach
            </div>
        @else
            <p>Không tìm thấy đơn hàng nào.</p>
        @endif
    @endif
@endsection
