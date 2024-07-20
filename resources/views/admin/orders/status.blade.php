@extends('admin.layout.master')

@section('title', 'Orders Status')

@if (session('success') || session('error'))
    <div class="alert-container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
@endif

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Orders Status</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                        <li class="breadcrumb-item active">Orders Status</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if (session('success') || session('error'))
        <div class="alert-container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="col-12 flex-wrap">
                @php
                    $statusIcons = [
                        'pending' => 'fas fa-hourglass-start',
                        'confirmed' => 'fas fa-check-circle',
                        'preparing_goods' => 'fas fa-cogs',
                        'shipping' => 'fas fa-truck',
                        'delivered' => 'fas fa-box-open',
                        'canceled' => 'fas fa-times-circle',
                    ];
                @endphp
                <a href="{{ route('admin.orders.status') }}" class="btn btn-outline-secondary mb-2">
                    <i class="fas fa-list me-1"></i> Tất cả
                </a>
                @foreach (\App\Models\Order::STATUS_ORDER as $key => $status)
                    <a href="{{ route('admin.orders.status', ['status_order' => $key]) }}"
                        class="btn btn-outline-primary me-2 mb-2 {{ request('status_order') == $key ? 'active' : '' }}">
                        <i class="{{ $statusIcons[$key] }} me-1"></i> {{ $status }}
                    </a>
                @endforeach

@section('title')
   Orders Status
@endsection
@section('content')
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


    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Status Orders</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                        <li class="breadcrumb-item active">Status Orders</li>
                    </ol>
                </div>


            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Orders Status</h4>

                    <form action="{{ route('admin.orders.update_multiple') }}" method="POST">
                        @csrf
                        {{-- @method('PUT') --}}
                        <input type="hidden" name="status_order" value="{{ request('status_order') }}">
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;"><input type="checkbox" id="checkAll"></th>
                                        <th>ID Order</th>
                                        <th>Trạng thái đơn hàng</th>
                                        @foreach (\App\Models\Order::STATUS_ORDER as $key => $status)
                                            <th>{{ $status }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="align-middle">
                                            <td><input type="checkbox" name="order_ids[]" value="{{ $order->id }}"></td>
                                            <td>{{ $order->id }}</td>
                                            <td>
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

                                                    $statusText =
                                                        \App\Models\Order::STATUS_ORDER[$order->status_order] ?? '-';
                                                @endphp
                                                <span class="badge {{ $statusClasses[$order->status_order] }}">
                                                    <i class="{{ $statusIcons[$order->status_order] }} me-1"></i>
                                                    {{ $statusText }}
                                                </span>
                                            </td>
                                            @foreach (\App\Models\Order::STATUS_ORDER as $key => $status)
                                                @php
                                                    $statusText = !empty($order->{$key . '_at'})
                                                        ? $order->{$key . '_at'}
                                                        : '-';
                                                    $statusIcon = 'fa-lg';
                                                    $statusConfig = [
                                                        'pending' => [
                                                            'fas fa-hourglass-start',
                                                            'bg-yellow-500',
                                                            'far fa-clock',
                                                        ],
                                                        'confirmed' => ['fas fa-check-circle', 'bg-green-500'],
                                                        'preparing_goods' => ['fas fa-cogs', 'bg-blue-500'],
                                                        'shipping' => ['fas fa-truck', 'bg-indigo-500'],
                                                        'delivered' => ['fas fa-box-open', 'bg-gray-500'],
                                                        'canceled' => ['fas fa-times-circle', 'bg-red-500'],
                                                    ];

                                                    $statusIconClass =
                                                        $statusConfig[$key][0] ?? 'fas fa-question-circle';
                                                    $statusClass = $statusConfig[$key][1] ?? 'bg-gray-500';

                                                    if ($order->status_order == $key) {
                                                        $statusClass = 'bg-success text-white';
                                                    }
                                                @endphp
                                                <td
                                                    class="px-4 py-3 rounded-lg shadow-sm {{ $statusClass }} relative group text-center align-middle">
                                                    <div class="mt-1">
                                                        <span class="ml-1 ">
                                                            <i class="{{ $statusIconClass }} {{ $statusIcon }}"></i>
                                                        </span>
                                                        <br>
                                                        <small class="text-gray-600">{{ $statusText }}</small>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        @if (!empty(session('filtered_status')) && $orders->isEmpty())
                            <div class="alert alert-success text-center">
                                Không còn đơn hàng nào ở trạng thái này
                            </div>
                        @endif
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Cập nhật trạng thái
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-libs')
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#checkAll').click(function() {
                $('input[name="order_ids[]"]').prop('checked', this.checked);
            });
        });
    </script>
@endsection

@section('style-libs')
    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css') }}">
@endsection

        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="orderList">
                            <div class="card-body pt-0">
                                <div>
                                    <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active All py-3" data-bs-toggle="tab" id="All"
                                                href="#home1" role="tab" aria-selected="true">
                                                <i class="ri-store-2-fill me-1 align-bottom"></i> All Status Orders
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="table-responsive table-card mb-1">
                                        <table class="table table-nowrap align-middle" id="orderTable">
                                            <thead class="text-muted table-light">
                                                <tr class="text-uppercase">
                                                    <th scope="col" style="width: 25px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                        </div>
                                                    </th>
                                                    <th data-sort="id">Order ID</th>
                                                    <th data-sort="status">Trạng thái đơn hàng</th>
                                                    @foreach (\App\Models\Order::STATUS_ORDER as $key => $status)
                                                        <th data-sort="payment">{{ $status }}</th>
                                                    @endforeach
                                                    {{-- <th data-sort="payment">Trạng thái thanh toán</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
                                                            </div>
                                                        </th>
                                                        <td class="id">{{ $order->id }}</td>
                                                        <td class="status">
                                                            <span class="badge bg-success-subtle text-primary text-uppercase">
                                                                {{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}
                                                            </span>
                                                        </td>
                                                        @foreach (\App\Models\Order::STATUS_ORDER as $key => $status)
                                                            @php
                                                                $statusClass = '';
                                                                if ($order->status_order == $key) {
                                                                    $statusClass = 'bg-success text-white';
                                                                }else{
                                                                    $statusClass = 'bg-warning';
                                                                }
                                                            @endphp
                                                            <td data-sort="payment" class="{{ $statusClass }}">{{ $order->{$key . '_at'} }}</td>
                                                        @endforeach
                                                        {{-- <td class="payment">
                                                            <span class="badge bg-success-subtle text-primary text-uppercase">
                                                                {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}
                                                            </span>
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                    colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                                <p class="text-muted">We've searched more than 150+ Orders We did not find any orders for you search.</p>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <style>
        border-radius: 3px;
    </style>
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <!-- list.js min js -->
    <script src="assets/libs/list.js/list.min.js"></script>

    <!--list pagination js-->
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>

    <!-- ecommerce-order init js -->
    <script src="assets/js/pages/ecommerce-order.init.js"></script>

    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script>
        DataTable('#example', {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection

