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
                            <input type="text" class="form-control" id="user_name" name="user_name" value="{{ old('user_name', $order->user_name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="user_email" name="user_email" value="{{ old('user_email', $order->user_email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_phone" class="form-label">Điện thoại</label>
                            <input type="text" class="form-control" id="user_phone" name="user_phone" value="{{ old('user_phone', $order->user_phone) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="user_address" name="user_address" value="{{ old('user_address', $order->user_address) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="total_price" class="form-label">Tổng giá tiền</label>
                            <input type="text" class="form-control" id="total_price" name="total_price" value="{{ old('total_price', $order->total_price) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="status_order" class="form-label">Trạng thái đơn hàng</label>
                            <select class="form-select" id="status_order" name="status_order" required>
                                @foreach(App\Models\Order::STATUS_ORDER as $key => $value)
                                    <option value="{{ $key }}" {{ old('status_order', $order->status_order) === $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status_payment" class="form-label">Trạng thái thanh toán</label>
                            <select class="form-select" id="status_payment" name="status_payment" required>
                                @foreach(App\Models\Order::STATUS_PAYMENT as $key => $value)
                                    <option value="{{ $key }}" {{ old('status_payment', $order->status_payment) === $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
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
