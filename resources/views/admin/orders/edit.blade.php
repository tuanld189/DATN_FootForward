@extends('admin.layout.master')
@section('title', 'Edit Order')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if (session('info'))
<div class="alert alert-info">
    {{ session('info') }}
</div>
@endif
@section('content')

    <!-- Error and Success Messages -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Orders</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Orders</a></li>
                        <li class="breadcrumb-item active">Edit Orders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- trang thái đơn hàng --}}
    <div class="order-status">
        <div class="progress" style="height: 35px">
            @foreach (\App\Models\Order::STATUS_ORDER as $key => $value)
                <div class="progress-bar {{ $order->status_order === $key ? 'bg-success' : 'bg-secondary' }}"
                    role="progressbar"
                    style="width: {{ 100 / count(\App\Models\Order::STATUS_ORDER) }}% ; border:1px solid; border-radius:1px; "
                    aria-valuenow="{{ 100 / count(\App\Models\Order::STATUS_ORDER) }}" aria-valuemin="" aria-valuemax="100">
                    {{ $value }}
                </div>
            @endforeach
        </div>

    </div>

    <!-- End Error and Success Messages -->
    <!-- End page title -->
    {{-- tesst --}}
    <div class="row justify-content-center">
        <div class="col-2xxl-9">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <img src="{{ asset('assets/images/verification-img.png') }}"
                                        class="card-logo card-logo-dark" alt="logo dark" height="80">
                                    <img src="{{ asset('assets/images/verification-img.png') }}"
                                        class="card-logo card-logo-light" alt="logo light" height="17">
                                    <div class="mt-sm-5 mt-4">
                                        <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                        <p class="text-muted mb-1" id="address-details">Hà Nội, Số 1 Trịnh Văn Bô</p>
                                        <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span> 90201</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 mt-sm-0 mt-5">
                                    <h6><span class="text-muted fw-normal">Legal Registration No:</span><span
                                            id="legal-register-no">987654</span></h6>
                                    <h6><span class="text-muted fw-normal">Email:</span><span
                                            id="email">footforward@order.com</span></h6>
                                    <h6><span class="text-muted fw-normal">Website:</span> <a
                                            href="https://themesbrand.com/" class="link-primary" target="_blank"
                                            id="website">www.footforward.com</a></h6>
                                    <h6 class="mb-0"><span class="text-muted fw-normal">Contact No: </span><span
                                            id="contact-no"> +(84) 9823 342 789</span></h6>
                                </div>
                            </div>
                        </div>
                        <!--end card-header-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Order Code</p>
                                    <h5 class="fs-14 mb-0">#FF<span id="invoice-no">{{ $order->id }}</span></h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                    <h5 class="fs-14 mb-0"><span
                                            id="invoice-date">{{ $order->created_at->format('d M, Y') }}</span> <small
                                            class="text-muted"
                                            id="invoice-time">{{ $order->created_at->format('h:i A') }}</small></h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Billing Address</h6>
                                    <p class="fw-medium mb-2" id="billing-name">{{ $order->user_name }}</p>
                                    <p class="text-muted mb-1" id="billing-address-line-1">{{ $order->user_address }}
                                    </p>
                                    <p class="text-muted mb-1"><span>Phone: (+84) </span><span
                                            id="billing-phone-no">{{ $order->user_phone }}</span></p>
                                    <p class="text-muted mb-0"><span>Tax: </span><span id="billing-tax-no">N/A</span>
                                    </p>


                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Shipping Address</h6>
                                    <p class="fw-medium mb-2" id="shipping-name">
                                        {{ $order->ship_user_name ?? $order->user_name }}</p>
                                    <p class="text-muted mb-1" id="shipping-address-line-1">
                                        {{ $order->ship_user_address ?? $order->user_address }}</p>
                                    <p class="text-muted mb-1"><span>Phone: +</span><span
                                            id="shipping-phone-no">{{ $order->ship_user_phone ?? $order->user_phone }}</span>
                                    </p>


                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount</p>
                                    <h5 class="fs-14 mb-0"><span
                                            id="total-amount">{{ number_format($order->total_price + 50000, 0, ',', '.') }}
                                        </span>VND



                                    </h5>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>

                    <!--end col-->

                    {{-- TRẠNG THÁI ĐƠN HÀNG, TRẠNG THÁI THANH TOÁN --}}
                    <div class="col-lg-12">
                        <div class="card-body p-4 border-top border-top-dashed">
                            <div class="row g-3">
                                <div class="col-12">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Order Status</p>
                                    <div class="row text-center">

                                        @foreach (\App\Models\Order::STATUS_ORDER as $statusKey => $statusValue)
                                            <div class="col-4 col-sm-3 col-md-2 mb-4 mt-2">
                                                @php
                                                    $icons = [
                                                        'pending' => 'fas fa-clock',
                                                        'confirmed' => 'fas fa-check-circle',
                                                        'preparing_goods' => 'fas fa-cogs',
                                                        'shipping' => 'fas fa-truck',
                                                        'delivered' => 'fas fa-box-open',
                                                        'canceled' => 'fas fa-times-circle',
                                                    ];
                                                @endphp
                                                <i
                                                    class="{{ $icons[$statusKey] }} fa-2x mb-2 {{ $order->status_order == $statusKey ? 'text-primary' : 'text-muted' }}"></i>
                                                <span
                                                    class="m-2 badge rounded-pill {{ $order->status_order == $statusKey ? 'bg-primary text-white' : 'bg-light text-muted' }} fs-6 d-block">
                                                    {{ $statusValue }}
                                                </span>
                                                @if (!empty($order->{$statusKey . '_at'}))
                                                    <div class="text-muted fs-6">
                                                        {{ $order->{$statusKey . '_at'} }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-12">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                    {{-- <span class="badge bg-success-subtle text-success fs-11" id="payment-status">
                                        {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}
                                    </span> --}}
                                    <span class="badge bg-primary text-white fs-6" id="payment-status">
                                        {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}
                                    </span>
                                </div>
                                @if (!empty($order->user_note))
                                    <div class="col-12">
                                        <h6 class="text-muted text-uppercase fw-semibold mb-3">Order Note</h6>
                                        <h3 class="badge bg-success-subtle text-black fs-15" id="order-status">
                                            {{ $order->user_note }}
                                        </h3>
                                    </div>
                                @endif
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-body-->


                    <div class="col-lg-12">
                        {{-- UPDATE --}}
                        <div class="card-footer border-top border-top-dashed px-4 py-3">
                            <p class="text-muted mb-2 text-uppercase fw-semibold">Update Status</p>
                            <div class="row g-3 m-auto">
                                <div class="col-4">
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')


                                        <label for="status_order">Trạng thái đơn hàng:</label>
                                        <select name="status_order" class="status-order form-control"
                                            data-id="{{ $order->id }}">
                                            @foreach (App\Models\Order::STATUS_ORDER as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $order->status_order === $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <label for="status_payment">Trạng thái thanh toán:</label>
                                        <select name="status_payment" class="status-payment form-control"
                                            data-id="{{ $order->id }}">
                                            @foreach (App\Models\Order::STATUS_PAYMENT as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $order->status_payment === $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </form>


                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-footer-->
                </div>
                <!--end col-->
            </div><!--end row-->
        </div><!--end card-->
    </div><!--end col-->
    </div>

@endsection
