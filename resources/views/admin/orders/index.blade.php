@extends('admin.layout.master')
@section('title')
    List Orders
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
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
    <!-- end page title -->
    <!-- Thông báo -->
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


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="orderList">
                            <div class="card-header border-0">
                                <div class="row align-items-center gy-3 ">
                                    <div class="col-sm d-flex justify-content-between">
                                        <h5 class="card-title mb-0">Order History</h5>
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="m-2">
                                                <a href="{{ route('admin.orders.export') }}" class="btn btn-success">Export
                                                    Orders</a>
                                            </div>
                                            <div class="m-2">
                                                <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">Thêm
                                                    mới</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- search order--------------------------------------------------------- --}}
                            <div class="card-body border border-dashed border-end-0 border-start-0">
                                <form>
                                    <div class="row g-3">
                                        <div class="col-xxl-5 col-sm-6">
                                            <div class="search-box">
                                                <input type="text" name="user_name" id="user_name"
                                                    value="{{ request('user_name') }}" class="form-control search"
                                                    placeholder="Search for order, customer...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-6">
                                            <div>
                                                <input type="date" class="form-control" name="date_to" id="date_to"
                                                    value="{{ request('date_to') }}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-4">
                                            <!-- File: resources/views/admin/orders/index.blade.php -->



                                            <div>
                                                <select class="form-control" data-choices data-choices-search-false
                                                    name="status_order" id="status_order">
                                                    <option value="">All</option>
                                                    @foreach (\App\Models\Order::STATUS_ORDER as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ request('status_order') == $key ? 'selected' : '' }}>
                                                            {{ $value }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-2 col-sm-4">
                                            <div>
                                                <select class="form-control" data-choices data-choices-search-false
                                                    name="status_payment" id="status_payment">
                                                    <option value="">All</option>
                                                    @foreach (\App\Models\Order::STATUS_PAYMENT as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ request('status_payment') == $key ? 'selected' : '' }}>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-1 col-sm-4">
                                            <div>
                                                <button type="submit" class="btn btn-primary w-100"
                                                    onclick="SearchData();"> <i
                                                        class="ri-equalizer-fill me-1 align-bottom"></i>
                                                    Filters
                                                </button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                            {{-- search order--------------------------------------------------------- --}}

                            <div class="card-body pt-0">

                                <div>
                                    <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active All py-3" data-bs-toggle="tab" id="All"
                                                href="#home1" role="tab" aria-selected="true">
                                                <i class="ri-store-2-fill me-1 align-bottom"></i> All Orders
                                            </a>
                                        </li>

                                    </ul>

                                    <div class="table-responsive table-card mb-1">
                                        <table class="table table-nowrap align-middle" id="orderTable">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    {{-- <th scope="col" style="width: 25px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="checkAll"
                                                                value="option">
                                                        </div>
                                                    </th> --}}
                                                    <th scope="col" style="width: 25px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="checkAll"
                                                                value="option">
                                                        </div>
                                                    </th>
                                                    <th data-sort="id">Order ID</th>
                                                    <th data-sort="customer_name">Khách hàng</th>
                                                    <th data-sort="product_name">SDT</th>
                                                    <th data-sort="product_address">Dịa chỉ</th>
                                                    <th data-sort="date">Ngày tạo</th>
                                                    <th data-sort="amount">Tổng tiền</th>
                                                    <th data-sort="payment">Trạng thái thanh toán</th>
                                                    <th data-sort="status">Tình trạng đơn hàng</th>
                                                    <th data-sort="city">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        {{-- <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="checkAll" value="option1">
                                                            </div>
                                                        </th> --}}
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td class="id">{{ $order->id }}</td>
                                                        <td class="customer_name">{{ $order->user_name }}</td>
                                                        <td class="customer_phone">{{ $order->user_phone }}</< /td>
                                                        <td class="customer_address">{{ $order->user_address }}</td>
                                                        <td class="date">
                                                            {{ $order->created_at->format('d-m-Y H:i:s') }}
                                                        </td>
                                                        <td class="amount">
                                                            {{ number_format($order->total_price, 0, ',', '.') }}

                                                        </td>
                                                        <td class="payment">
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
                                                            <span class="badge {{ $paymentClasses[$order->status_payment] }} text-uppercase">
                                                                <i class="{{ $paymentIcons[$order->status_payment] }} me-1"></i>
                                                                {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}
                                                            </span>
                                                        </td>
                                                        <td class="status">
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
                                                            <span class="badge {{ $statusClasses[$order->status_order] }} text-uppercase">
                                                                <i class="{{ $statusIcons[$order->status_order] }} me-1"></i>
                                                                {{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <ul class="list-inline hstack gap-2 mb-0">
                                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                    data-bs-trigger="hover" data-bs-placement="top"
                                                                    title="View">
                                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                                        class="text-primary d-inline-block">
                                                                        <i class="ri-eye-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                    data-bs-trigger="hover" data-bs-placement="top"
                                                                    title="View">
                                                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                                        class="text-primary d-inline-block">
                                                                        <i class="ri-pencil-fill fs-16"></i>
                                                                    </a>
                                                                </li>
                                                                {{-- <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                    data-bs-trigger="hover" data-bs-placement="top"
                                                                    title="Remove">
                                                                    <form id="delete-form-{{ $order->id }}"
                                                                        action="{{ route('admin.orders.destroy', $order->id) }}"
                                                                        method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                    <a href="#" class="text-danger d-inline-block"
                                                                        onclick="event.preventDefault(); if(confirm('Bạn có muốn xóa không')) document.getElementById('delete-form-{{ $order->id }}').submit();">
                                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                    </a>
                                                                </li> --}}

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                    colors="primary:#405189,secondary:#0ab39c"
                                                    style="width:75px;height:75px"></lord-icon>
                                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                                <p class="text-muted">We've searched more than 150+ Orders We did not
                                                    find any orders for you search.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <div class="pagination-wrap hstack gap-2">
                                            <a class="page-item pagination-prev disabled" href="#">
                                                Previous
                                            </a>
                                            <ul class="pagination listjs-pagination mb-0"></ul>
                                            <a class="page-item pagination-next" href="#">
                                                Next
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--end modal -->
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    <!--end col-->
                </div>

            </div>
        </div>
    </div><!--end col-->
    </div><!--end row-->
@endsection



@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css') }}" />
    <!--datatable responsive css-->
    <link rel="stylesheet"
        href="{{ asset('https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css') }}">
@endsection

@section('script-libs')
    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="{{ asset('https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <!-- list.js min js -->
    <script src="{{ asset('assets/libs/list.js/list.min.js') }}"></script>

    <!--list pagination js-->
    <script src="{{ asset('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!-- ecommerce-order init js -->
    <script src="{{ asset('assets/js/pages/ecommerce-order.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <!-- list.js min js -->
    <script src="{{ asset('assets/libs/list.js/list.min.js') }}"></script>

    <!--list pagination js-->
    <script src="{{ asset('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!-- ecommerce-order init js -->
    <script src="{{ asset('assets/js/pages/ecommerce-order.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        DataTable('#example', {
            order: [
                [0, 'desc']
            ]
        });
    </script>
     <script>
        DataTable('#example', {
            order: [
                [0, 'desc']
            ]
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.status-order, .status-payment').change(function() {
                var id = $(this).data('id');
                var statusOrder = $(this).closest('tr').find('.status-order').val();
                var statusPayment = $(this).closest('tr').find('.status-payment').val();

                $.ajax({
                    url: '/admin/orders/update-status/' + id,
                    type: 'PATCH',
                    data: {
                        status_order: statusOrder,
                        status_payment: statusPayment,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#success-message').text(response.message).show().delay(3000)
                            .fadeOut();
                    },
                    error: function(xhr) {
                        alert('Đã xảy ra lỗi khi cập nhật trạng thái đơn hàng.');
                    }
                });
            });
        });
    </script>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('.status-order, .status-payment').change(function() {
                var id = $(this).data('id');
                var statusOrder = $(this).closest('tr').find('.status-order').val();
                var statusPayment = $(this).closest('tr').find('.status-payment').val();

                $.ajax({
                    url: '/admin/orders/update-status/' + id,
                    type: 'PATCH',
                    data: {
                        status_order: statusOrder,
                        status_payment: statusPayment,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#success-message').text(response.message).show().delay(3000)
                            .fadeOut();
                    },
                    error: function(xhr) {
                        alert('Đã xảy ra lỗi khi cập nhật trạng thái đơn hàng.');
                    }
                });
            });
        });
    </script>
@endsection
