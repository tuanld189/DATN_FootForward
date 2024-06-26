@extends('admin.layout.master')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<style>
    .invoice{
        background:rgb(239, 238, 238);
    }
</style>

<div class="invoice">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Order Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Orders</a></li>
                                <li class="breadcrumb-item active">Invoice Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row justify-content-center">
                <div class="col-xxl-9">
                    <div class="card" id="demo">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-header border-bottom-dashed p-4">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <img src="{{ asset('assets/images/verification-img.png') }}" class="card-logo card-logo-dark" alt="logo dark" height="80">
                                            <img src="{{ asset('assets/images/verification-img.png') }}" class="card-logo card-logo-light" alt="logo light" height="17">
                                            <div class="mt-sm-5 mt-4">
                                                <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                                <p class="text-muted mb-1" id="address-details">Hà Nội, Số 1 Trịnh Văn Bô</p>
                                                <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span> 90201</p>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 mt-sm-0 mt-5">
                                            <h6><span class="text-muted fw-normal">Legal Registration No:</span><span id="legal-register-no">987654</span></h6>
                                            <h6><span class="text-muted fw-normal">Email:</span><span id="email">footforward@order.com</span></h6>
                                            <h6><span class="text-muted fw-normal">Website:</span> <a href="https://themesbrand.com/" class="link-primary" target="_blank" id="website">www.footforward.com</a></h6>
                                            <h6 class="mb-0"><span class="text-muted fw-normal">Contact No: </span><span id="contact-no"> +(84) 9823 342 789</span></h6>
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
                                            <h5 class="fs-14 mb-0"><span id="invoice-date">{{ $order->created_at->format('d M, Y') }}</span> <small class="text-muted" id="invoice-time">{{ $order->created_at->format('h:i A') }}</small></h5>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-6">
                                            <p class="text-muted mb-2 text-uppercase fw-semibold">Oder Status</p>
                                            <span class="badge bg-success-subtle text-success fs-11" id="oder-status">{{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}</span>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-6">
                                            <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                            <span class="badge bg-success-subtle text-success fs-11" id="payment-status">{{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}</span>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-3 col-6">
                                            <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount</p>
                                            <h5 class="fs-14 mb-0">$<span id="total-amount">{{ number_format($order->total_price + 50, 2) }}</span></h5>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end card-body-->
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="card-body p-4 border-top border-top-dashed">
                                    <div class="row g-3">
                                        <div class="col-4">
                                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Billing Address</h6>
                                            <p class="fw-medium mb-2" id="billing-name">{{ $order->user_name }}</p>
                                            <p class="text-muted mb-1" id="billing-address-line-1">{{ $order->user_address }}</p>
                                            <p class="text-muted mb-1"><span>Phone: (+84) </span><span id="billing-phone-no">{{ $order->user_phone }}</span></p>
                                            <p class="text-muted mb-0"><span>Tax: </span><span id="billing-tax-no">N/A</span> </p>
                                        </div>
                                        <!--end col-->
                                        <div class="col-4">
                                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Shipping Address</h6>
                                            <p class="fw-medium mb-2" id="shipping-name">{{ $order->ship_user_name ?? $order->user_name }}</p>
                                            <p class="text-muted mb-1" id="shipping-address-line-1">{{ $order->ship_user_address ?? $order->user_address }}</p>
                                            <p class="text-muted mb-1"><span>Phone: +</span><span id="shipping-phone-no">{{ $order->ship_user_phone ?? $order->user_phone }}</span></p>

                                        </div>
                                        <div class="col-4">
                                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Order Note </h6>
                                            <p class="text-muted mb-1" id="user-note">{{ $order->user_note }}</p>

                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end card-body-->
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="card-body p-4">
                                    <div class="table-responsive">
                                        <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                            <thead>
                                                <tr class="table-active">
                                                    <th scope="col" style="width: 50px;">#</th>
                                                    <th scope="col">Product Details</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Color</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col" class="text-end">Amount</th>
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
                                                        <td>${{ number_format($item->product_price, 2) }}</td>
                                                        <td>{{ $item->variant_color_name }}</td>
                                                        <td>{{ $item->variant_size_name  }}</td>
                                                        <td>{{ $item->quantity_add }}</td>
                                                        <td class="text-end">${{ number_format($item->product_price * $item->quantity_add, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table><!--end table-->
                                    </div>
                                    <div class="border-top border-top-dashed mt-2">
                                        <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                            <tbody>
                                                <tr>
                                                    <td>Sub Total</td>
                                                    <td class="text-end" id="sub-total-amount">${{ number_format($order->total_price, 2)  }}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td>Estimated Tax (12.5%)</td>
                                                    <td class="text-end">$<span id="tax-amount">34.25</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Discount <span class="text-muted">(VELZON15)</span></td>
                                                    <td class="text-end" id="discount-amount">-$<span>10.25</span></td>
                                                </tr> --}}
                                                <tr>
                                                    <td>Shipping <span class="text-muted"></span></td>
                                                    <td class="text-end">+$<span>50</span></td>
                                                </tr>
                                                <tr class="border-top border-top-dashed fs-15">
                                                    <th scope="row">Total Amount</th>
                                                    <th class="text-end" id="final-amount">${{ number_format($order->total_price + 50, 2)  }}</th>
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
                                                <a href="javascript:window.print()" class="btn btn-primary"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                                                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary ">
                                                    Back</a>
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
            </div><!--end row-->
        </div><!-- container-fluid -->
    </div><!-- End Page-content -->
</div><!-- end main content-->

<script src="assets/js/pages/invoices.js "></script>
@endsection
