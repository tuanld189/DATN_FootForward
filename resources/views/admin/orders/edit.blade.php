@extends('admin.layout.master')
@section('title', 'Chỉnh sửa đơn hàng')

@section('content')
    <!-- Page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Chỉnh sửa đơn hàng</h4>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Form -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="user_name" class="form-label">Tên người đặt</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" value="{{ $order->user_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="user_email" name="user_email" value="{{ $order->user_email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_phone" class="form-label">Điện thoại</label>
                            <input type="text" class="form-control" id="user_phone" name="user_phone" value="{{ $order->user_phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="user_address" name="user_address" value="{{ $order->user_address }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="total_price" class="form-label">Tổng giá tiền</label>
                            <input type="text" class="form-control" id="total_price" name="total_price" value="{{ $order->total_price }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="status_order" class="form-label">Trạng thái đơn hàng</label>
                            <select class="form-select" id="status_order" name="status_order" required>
                                <option value="pending" {{ $order->status_order == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                <option value="confirmed" {{ $order->status_order == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                <option value="preparing_goods" {{ $order->status_order == 'preparing_goods' ? 'selected' : '' }}>Đang chuẩn bị hàng</option>
                                <option value="shipping" {{ $order->status_order == 'shipping' ? 'selected' : '' }}>Đang vận chuyển</option>
                                <option value="delivered" {{ $order->status_order == 'delivered' ? 'selected' : '' }}>Đã giao hàng</option>
                                <option value="canceled" {{ $order->status_order == 'canceled' ? 'selected' : '' }}>Đơn hàng đã bị hủy</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status_payment" class="form-label">Trạng thái thanh toán</label>
                            <select class="form-select" id="status_payment" name="status_payment" required>
                                <option value="unpaid" {{ $order->status_payment == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                                <option value="paid" {{ $order->status_payment == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Form -->
@endsection
