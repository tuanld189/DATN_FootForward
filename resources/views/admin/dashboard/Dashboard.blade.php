@extends('admin.layout.master')

@section('title')
    Thống kê
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Good Morning, {{ Auth::user()->name }}!</h4>
                                <p class="text-muted mb-0">Đây là thống kê cửa hàng của bạn.</p>
                            </div>
                            {{-- <div class="mt-3 mt-lg-0">
                                <form action="javascript:void(0);">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-sm-auto">
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control border-0 dash-filter-picker shadow"
                                                    data-provider="flatpickr" data-range-date="true"
                                                    data-date-format="d M, Y"
                                                    data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                <div class="input-group-text bg-primary border-primary text-white">
                                                    <i class="ri-calendar-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-soft-success"><i
                                                    class="ri-add-circle-line align-middle me-1"></i> Add Product</button>
                                        </div>
                                        <!--end col-->
                                        <div class="col-auto">
                                            <button type="button"
                                                class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i
                                                    class="ri-pulse-line"></i></button>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div> --}}
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tổng doanh thu</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ number_format($totalRevenue, 0, ',', '.') }} VNĐ
                                        </h4>
                                        <a href="{{ route('admin.dashboard.RevenueDetail', ['filter' => 'this_week']) }}"
                                            class="text-decoration-underline">Xem chi tiết</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Đơn hàng</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ number_format($totalOrders, 0, ',', '.') }}
                                        </h4>
                                        <a href="{{ route('admin.dashboard.OrderDetail') }}"
                                            class="text-decoration-underline">Xem chi tiết</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                            <i class="bx bx-shopping-bag text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Người dùng</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ number_format($totalCustomers, 0, ',', '.') }}
                                        </h4>
                                        <a href="{{ route('admin.dashboard.UserDetail') }}"
                                            class="text-decoration-underline">Xem chi tiết</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-user text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tổng sản phẩm đã
                                            bán</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value" data-target="{{ $totalProductsSold }}">0</span>
                                        </h4>
                                        <a href="{{ route('admin.dashboard.ProductSoldDetail') }}"
                                            class="text-decoration-underline">Xem chi tiết</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-wallet text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->


                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">DOANH THU</h4>
                                <div>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        Theo ngày
                                    </button>
                                    {{-- <button type="button" class="btn btn-soft-secondary btn-sm">
                                        1 THÁNG
                                    </button>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        6 THÁNG
                                    </button>
                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                        1 NĂM
                                    </button> --}}
                                </div>
                            </div><!-- end card header -->

                            <div class="card-header p-0 border-0 bg-light-subtle">
                                <div class="row g-0 text-center">
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1">{{ number_format($totalOrdersToday, 0, ',', '.') }}</h5>
                                            <p class="text-muted mb-0">ĐƠN HÀNG (Hôm nay)</p>
                                            <small class="text-muted">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</small>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1">{{ number_format($totalRevenueToday, 0, ',', '.') }}VNĐ</h5>
                                            <p class="text-muted mb-0">THU NHẬP (Hôm nay)</p>
                                            <small class="text-muted">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</small>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1">{{ number_format($totalCustomersToday, 0, ',', '.') }}</h5>
                                            <p class="text-muted mb-0">NGƯỜI DÙNG (Hôm nay)</p>
                                            <small class="text-muted">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</small>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1">{{ number_format($totalProductsSoldToday, 0, ',', '.') }}
                                            </h5>
                                            <p class="text-muted mb-0">SẢN PHẨM BÁN RA (Hôm nay)</p>
                                            <small class="text-muted">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="customer_impression_charts"
                                        data-colors='["--vz-primary", "--vz-success", "--vz-danger"]' class="apex-charts"
                                        dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <!-- card -->
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">THỐNG KÊ DOANH MỤC NỔI BẬT</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                @if ($topCategories->isEmpty())
                                    <p>Không có dữ liệu để hiển thị biểu đồ.</p>
                                @else
                                    <div id="top-categories-pie-chart" class="apex-charts" dir="ltr"></div>
                                @endif

                            </div>
                        </div> <!-- .card-->

                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">SẢN PHẨM BÁN CHẠY</h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="fw-semibold text-uppercase fs-12">Theo: </span>
                                            <span class="text-muted">
                                                @if ($filter === 'today')
                                                    Hôm nay
                                                @elseif($filter === '7days')
                                                    7 ngày
                                                @elseif($filter === '1month')
                                                    1 tháng
                                                @else
                                                    Tất cả
                                                @endif
                                                <i class="mdi mdi-chevron-down ms-1"></i>
                                            </span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.dashboard', ['filter' => 'today']) }}">Hôm nay</a>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.dashboard', ['filter' => '7days']) }}">7 ngày</a>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.dashboard', ['filter' => '1month']) }}">1 tháng</a>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.dashboard', ['filter' => 'all']) }}">Tất cả</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    @if ($topProducts->isNotEmpty())
                                        <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Thuộc tính</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($topProducts as $product)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                    <img src="{{ asset('storage/' . $product->product_image) }}"
                                                                        alt="" class="img-fluid d-block" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1">
                                                                        <a href="{{ route('admin.products.show', $product->product_variant_id) }}"
                                                                            class="text-reset">
                                                                            {{ $product->product_name }}
                                                                        </a>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">
                                                                ${{ number_format($product->product_price, 2) }}</h5>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">
                                                                {{ $product->total_quantity }}</h5>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">
                                                                {{ $product->variant_size_name }} /
                                                                {{ $product->variant_color_name }}</h5>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p style="text-align: center">Không có sản phẩm bán chạy nào.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">ĐƠN HÀNG GẦN ĐÂY</h4>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-info btn-sm">
                                        <a href="{{ route('admin.orders.index') }}">Tất cả đơn hàng</a>
                                    </button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">Mã đơn hàng</th>
                                                <th scope="col">Người dùng</th>
                                                {{-- <th scope="col">Sản phẩm</th> --}}
                                                <th scope="col">Tổng giá</th>
                                                <th scope="col">Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recentOrders as $order)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                                            class="fw-medium link-primary">#{{ $order->order_code }}</a>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-2">
                                                                <img src="{{ Auth::check() && Auth::user()->photo_thumbs ? Storage::url(Auth::user()->photo_thumbs) : asset('assets/images/banner/Avatardf.jpg') }}"
                                                                    alt="" class="avatar-xs rounded-circle" />
                                                            </div>
                                                            {{-- <div class="flex-grow-1">{{ $order->user->name }}</div> --}}
                                                        </div>
                                                    </td>
                                                    {{-- <td>
                                                    {{ $order->orderItems->pluck('product_name')->implode(', ') }}
                                                </td> --}}
                                                    <td>
                                                        <span
                                                            class="text-success">${{ number_format($order->total_price, 2) }}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge
                                                        {{ $order->status == 'paid' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }}">
                                                            {{ ucfirst($order->status_order) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                        {{-- <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Top Sellers</h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
<a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted">Report<i
                                                    class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Download Report</a>
                                            <a class="dropdown-item" href="#">Export</a>
                                            <a class="dropdown-item" href="#">Import</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/companies/img-1.png" alt=""
                                                                class="avatar-sm p-2" />
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1 fw-medium">
                                                                <a href="apps-ecommerce-seller-details.html"
                                                                    class="text-reset">iTest Factory</a>
                                                            </h5>
                                                            <span class="text-muted">Oliver Tyler</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Bags and Wallets</span>
                                                </td>
                                                <td>
                                                    <p class="mb-0">8547</p>
                                                    <span class="text-muted">Stock</span>
                                                </td>
<td>
                                                    <span class="text-muted">$541200</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">32%<i
                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                    </h5>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/companies/img-2.png" alt=""
                                                                class="avatar-sm p-2" />
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-14 my-1 fw-medium"><a
                                                                    href="apps-ecommerce-seller-details.html"
                                                                    class="text-reset">Digitech Galaxy</a></h5>
                                                            <span class="text-muted">John Roberts</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Watches</span>
                                                </td>
                                                <td>
                                                    <p class="mb-0">895</p>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted">$75030</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">79%<i
                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                    </h5>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
<td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/companies/img-3.png" alt=""
                                                                class="avatar-sm p-2" />
                                                        </div>
                                                        <div class="flex-gow-1">
                                                            <h5 class="fs-14 my-1 fw-medium"><a
                                                                    href="apps-ecommerce-seller-details.html"
                                                                    class="text-reset">Nesta Technologies</a></h5>
                                                            <span class="text-muted">Harley Fuller</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Bike Accessories</span>
                                                </td>
                                                <td>
                                                    <p class="mb-0">3470</p>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted">$45600</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">90%<i
                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                    </h5>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/companies/img-8.png" alt=""
                                                                class="avatar-sm p-2" />
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-14 my-1 fw-medium"><a
href="apps-ecommerce-seller-details.html"
                                                                    class="text-reset">Zoetic Fashion</a></h5>
                                                            <span class="text-muted">James Bowen</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Clothes</span>
                                                </td>
                                                <td>
                                                    <p class="mb-0">5488</p>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted">$29456</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">40%<i
                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                    </h5>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="assets/images/companies/img-5.png" alt=""
                                                                class="avatar-sm p-2" />
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-14 my-1 fw-medium">
                                                                <a href="apps-ecommerce-seller-details.html"
                                                                    class="text-reset">Meta4Systems</a>
                                                            </h5>
                                                            <span class="text-muted">Zoe Dennis</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Furniture</span>
</td>
                                                <td>
                                                    <p class="mb-0">4100</p>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted">$11260</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">57%<i
                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                    </h5>
                                                </td>
                                            </tr><!-- end -->
                                        </tbody>
                                    </table><!-- end table -->
                                </div>

                                <div
                                    class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                    <div class="col-sm">
                                        <div class="text-muted">
                                            Showing <span class="fw-semibold">5</span> of <span
                                                class="fw-semibold">25</span> Results
                                        </div>
                                    </div>
                                    <div class="col-sm-auto  mt-3 mt-sm-0">
                                        <ul
                                            class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                            <li class="page-item disabled">
                                                <a href="#" class="page-link">←</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">1</a>
                                            </li>
                                            <li class="page-item active">
                                                <a href="#" class="page-link">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">→</a>
                                            </li>
                                        </ul>
                                    </div>
</div>

                            </div> <!-- .card-body-->
                        </div> <!-- .card--> --}}
                    </div> <!-- .col-->
                </div> <!-- end row-->

            </div> <!-- end .h-100-->
        </div> <!-- end col -->
    </div>
@endsection


@section('script-libs')
    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
@endsection

@section('style-libs')
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Include ApexCharts Library -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Daily statistics line chart
            var lineChartOptions = {
                chart: {
                    height: 350,
                    type: 'line',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Đơn hàng',
                    data: @json($totalOrdersPerDay)
                }, {
                    name: 'Thu nhập',
                    data: @json($totalRevenuePerDay)
                }, {
                    name: 'Người dùng',
                    data: @json($totalCustomersPerDay)
                }, {
                    name: 'Sản phẩm bán',
                    data: @json($totalProductsSoldPerDay)
                }],
                xaxis: {
                    categories: @json($dates),
                    title: {
                        text: 'Ngày'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Giá trị'
                    }
                },
                colors: ['#34c38f', '#f46a6a', '#556ee6', '#f1b44c'],
                stroke: {
                    width: 2
                }
            };

            var lineChart = new ApexCharts(document.querySelector("#customer_impression_charts"), lineChartOptions);
            lineChart.render();

            // Top categories pie chart
            var pieChartOptions = {
                series: @json($topCategories->pluck('percentage')),
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: @json($topCategories->pluck('name')),
                colors: ['#556ee6', '#34c38f', '#f46a6a', '#f1b44c', '#50a5f1'],
                legend: {
                    position: 'bottom'
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val.toFixed(2) + "%";
                    }
                }
            };

            var pieChart = new ApexCharts(document.querySelector("#top-categories-pie-chart"), pieChartOptions);
            pieChart.render();

        });
    </script>
@endsection
