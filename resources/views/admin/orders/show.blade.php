@extends('admin.layout.master')

@section('title', 'Show Detail Order')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Chi tiết đơn hàng</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Đơn hàng</a></li>
                            <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

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
        <!-- end page title -->
        <!-- end page title -->
        {{-- trang thái đơn hàng --}}
        {{-- <div class="order-status">
            <div class="progress" style="height: 30px">
                @foreach (\App\Models\Order::STATUS_ORDER as $key => $value)
                    <div class="progress-bar {{ $order->status_order === $key ? 'bg-success' : 'bg-secondary' }}"
                        role="progressbar"
                        style="width: {{ 100 / count(\App\Models\Order::STATUS_ORDER) }}% ; border:1px solid; border-radius:1px; "
                        aria-valuenow="{{ 100 / count(\App\Models\Order::STATUS_ORDER) }}" aria-valuemin=""
                        aria-valuemax="100">
                        {{ $value }}
                    </div>
                @endforeach
            </div>

        </div> --}}


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
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="row g-3">


                                </div>

                            </div>
                        </div>
                        <!--end col-->

                        {{-- TRẠNG THÁI ĐƠN HÀNG, TRẠNG THÁI THANH TOÁN --}}
                        <div class="col-lg-12">
                            <div class="card-body p-4 border-top border-top-dashed">
                                <div class="row g-3">
                                    <div class="container-fluid h-100">
                                        <div class="row justify-content-center align-items-center h-100">
                                            <div class="col-12">
                                                <div class="card shadow-lg">
                                                    <div class="card-header bg-white border-bottom">
                                                        <h4 class="card-title mb-0 text-primary">Trạng thái đơn hàng</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row text-center">
                                                            @foreach (\App\Models\Order::STATUS_ORDER as $statusKey => $statusValue)
                                                                <div class="col-4 col-sm-3 col-md-2 mb-4">
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
                                                    {{-- <div class="card-footer bg-white border-top">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 text-muted">
                                                                <p class="mb-0 text-uppercase fw-semibold">Legend</p>
                                                                <ul class="list-unstyled">
                                                                    @foreach (\App\Models\Order::STATUS_ORDER as $statusKey => $statusValue)
                                                                        <li>
                                                                            <i class="{{ $icons[$statusKey] }} me-2"></i>
                                                                            <span
                                                                                class="badge rounded-pill {{ $order->status_order == $statusKey ? 'bg-primary text-white' : 'bg-light text-muted' }} me-2"></span>
                                                                            {{ $statusValue }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <div
                                                                class="col-12 col-md-6 d-flex align-items-center justify-content-end">
                                                                <a href="#" class="btn btn-primary btn-sm">View
                                                                    Order
                                                                    Details</a>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Trạng thái thanh toán</p>
                                        {{-- <span class="badge bg-success-subtle text-success fs-11" id="payment-status">
                                            {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}
                                        </span> --}}
                                        <span class="badge bg-success-subtle text-success fs-5" id="payment-status">
                                            {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}
                                        </span>
                                    </div>
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




                    <!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">Thông tin chi tiết sản phẩm</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Màu</th>
                                            <th scope="col">Kích cỡ</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col" class="text-end">Giá tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        @foreach ($orderItems as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td class="text-start">
                                                    <span class="fw-medium">{{ $item->product_name }}</span>
                                                    <p class="text-muted mb-0">SKU: {{ $item->product_sku }}</p>
                                                </td>
                                                <td> {{ number_format($item->product_price, 0, ',', '.') }} VND</td>
                                                <td>{{ $item->variant_color_name }}</td>
                                                <td>{{ $item->variant_size_name }}</td>
                                                <td>{{ $item->quantity_add }}</td>
                                                <td class="text-end">
                                                    {{ number_format($item->product_price * $item->quantity_add, 0, ',', '.') }}
                                                    VND

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><!--end table-->
                            </div>
                            <div class="border-top border-top-dashed mt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                    style="width:250px">
                                    <tbody>
                                        <tr>
                                            <td colspan="3"><span><b>Tổng tiền sản phẩm</b></span></td>
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
                                                <td colspan="3"><span>Mã giảm giá</span></td>
                                                <td><span
                                                        class="amount">-{{ number_format(session('discount'), 0, ',', '.') }}
                                                        VNĐ</span></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3"><span>Phí vận chuyển</span></td>
                                            {{-- <td>{{ number_format(50000, 0, ',', '.') }} VNĐ</td> --}}
                                            <td>{{ number_format(0, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><span><b>Tổng hóa đơn</b></span></td>
                                            {{-- <td><b>{{ number_format($order->total_price + 50000, 0, ',', '.') }} VNĐ</b></td> --}}
                                            <td><b>{{ number_format($order->total_price + 0, 0, ',', '.') }} VNĐ</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end card-body-->
                        <div class="card-footer border-top border-top-dashed px-4 py-3">
                            <div class="row g-3">
                                {{-- <div class="col-sm-auto">
                                        <a href="apps-invoices.html" class="btn btn-link text-muted d-print-none"><i class="ri-download-2-line align-middle"></i> Download</a>
                                    </div> --}}
                                <!--end col-->
                                <div class="col-sm">
                                    <div class="text-sm-end">
                                        <a href="javascript:window.print()" class="btn btn-primary"><i
                                                class="ri-printer-line align-bottom me-1"></i> Print</a>
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary ">
                                            Back</a>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>

                        <!--end row-->
                    </div>
                    <!--end col-->
                </div><!--end row-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->
    </div>
@endsection


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
