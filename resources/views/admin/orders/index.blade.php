@extends('admin.layout.master')
@section('title')
    List Orders
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý</a></li>
                        <li class="breadcrumb-item active">Đơn hàng</li>
                        <li class="breadcrumb-item active">Danh sách đơn hàng</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <style>
        .status-form {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            min-width: 400px;
            background-color: #fff;
            padding: 30px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .status-form.show {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }

        .status-form.hide {
            opacity: 0;
            visibility: hidden;
            transform: translate(-50%, -50%) scale(0.9);
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 20px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
        }

        .close-button:hover {
            color: #ff0000;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%) scale(0.9);
                /* Bắt đầu từ ngoài màn hình và nhỏ hơn */
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
                /* Kết thúc tại vị trí giữa màn hình và kích thước bình thường */
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }

            to {
                opacity: 0;
                transform: translate(-50%, -60%) scale(0.9);
                /* Biến mất dần và nhỏ lại */
            }
        }

        .alert {
            position: fixed;
            /* top: 50%; */
            left: 60%;
            transform: translate(-50%, -50%);
            /* transform: translate(-50%); */
            z-index: 1050;
            opacity: 0;
            max-width: 400px;
            width: 100%;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: none;
            /* Ẩn thông báo mặc định */
        }

        .alert.show {
            display: block;
            /* Hiển thị thông báo khi có lớp show */
            animation: fadeIn 0.5s forwards;
            /* Hiệu ứng hiện ra */
        }

        .alert.hide {
            animation: fadeOut 0.5s forwards;
            /* Hiệu ứng biến mất */
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert .alert-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .alert .alert-content {
            display: flex;
            align-items: center;
        }
    </style>

    <!-- Thông báo thành công -->
    {{-- @if (session('success'))
        <div id="success-alert" class="alert alert-success show">
            <div class="alert-content">
                <i class="ri-check-line alert-icon"></i> <!-- Thay đổi icon tùy theo nhu cầu -->
                {{ session('success') }}
            </div>
        </div>
    @endif --}}

        <!-- Thông báo thành công -->
        @if (session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="alert-content">
                <i class="ri-check-line alert-icon"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Thông báo lỗi -->
    @if (session('error'))
        <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="alert-content">
                <i class="ri-close-line alert-icon"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
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
                                        <h5 class="card-title mb-0">Đơn hàng</h5>
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="m-2">
                                                <a href="{{ route('admin.orders.export') }}" class="btn btn-success">Xuất
                                                    excel </a>
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
                                                    <option value="">Tất cả</option>
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
                                                    <option value="">Tất cả</option>
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
                                                    Lọc
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
                                                    <th data-sort="id">Mã đơn hàng</th>
                                                    <th data-sort="customer_name">Khách hàng</th>
                                                    <th data-sort="product_name">SDT</th>
                                                    <th data-sort="product_address">Dịa chỉ</th>
                                                    <th data-sort="date">Ngày tạo</th>
                                                    <th data-sort="amount">Tổng tiền</th>
                                                    <th data-sort="payment">Trạng thái thanh toán</th>
                                                    <th data-sort="status">Tình trạng đơn hàng</th>
                                                    <th data-sort="city">Chức năng</th>
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
                                                        <td class="id">{{ $order->order_code }}</td>
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
                                                            <span
                                                                class="badge {{ $paymentClasses[$order->status_payment] }} text-uppercase">
                                                                <i
                                                                    class="{{ $paymentIcons[$order->status_payment] }} me-1"></i>
                                                                {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}
                                                            </span>
                                                            {{-- <span class="badge {{ $statusClasses[$order->status_order] }} text-uppercase">
                                                                <i class="{{ $statusIcons[$order->status_order] }} me-1"></i>
                                                                {{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}
                                                            </span> --}}
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
                                                            <span
                                                                class="badge {{ $statusClasses[$order->status_order] }} text-uppercase">
                                                                <i
                                                                    class="{{ $statusIcons[$order->status_order] }} me-1"></i>
                                                                {{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <!-- Xem đơn hàng -->
                                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                                    class="btn btn-outline-primary me-2"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Xem">
                                                                    <i class="ri-eye-fill fs-16"></i>
                                                                </a>

                                                                <div class="d-flex align-items-center position-relative">
                                                                    <!-- Icon cập nhật trạng thái đơn hàng và thanh toán -->
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-outline-primary me-2"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Cập nhật trạng thái"
                                                                        onclick="toggleStatusForm('{{ $order->id }}')">
                                                                        <i class="ri-edit-box-fill fs-16"></i>
                                                                    </a>

                                                                    <!-- Form ẩn hiện cập nhật trạng thái đơn hàng và thanh toán -->
                                                                    <form id="status-form-{{ $order->id }}"
                                                                        action="{{ route('admin.orders.update', $order->id) }}"
                                                                        method="POST" class="status-form"
                                                                        style="display: none;">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <button type="button" class="close-button"
                                                                            onclick="toggleStatusForm('{{ $order->id }}')">&times;</button>
                                                                        <div class="mb-3">
                                                                            <label for="status_order_{{ $order->id }}"
                                                                                class="form-label">Trạng thái đơn
                                                                                hàng:</label>
                                                                            <select name="status_order"
                                                                                id="status_order_{{ $order->id }}"
                                                                                class="form-select form-select-sm">
                                                                                @foreach (App\Models\Order::STATUS_ORDER as $key => $value)
                                                                                    <option value="{{ $key }}"
                                                                                        {{ $order->status_order === $key ? 'selected' : '' }}>
                                                                                        {{ $value }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label
                                                                                for="status_payment_{{ $order->id }}"
                                                                                class="form-label">Trạng thái thanh
                                                                                toán:</label>
                                                                            <select name="status_payment"
                                                                                id="status_payment_{{ $order->id }}"
                                                                                class="form-select form-select-sm">
                                                                                @foreach (App\Models\Order::STATUS_PAYMENT as $key => $value)
                                                                                    <option value="{{ $key }}"
                                                                                        {{ $order->status_payment === $key ? 'selected' : '' }}>
                                                                                        {{ $value }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <button type="submit"
                                                                            class="btn btn-primary btn-sm">Cập
                                                                            nhật</button>
                                                                    </form>
                                                                </div>
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



{{-- @section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css') }}" />
    <!--datatable responsive css-->
    <link rel="stylesheet"
        href="{{ asset('https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css') }}">
@endsection --}}

@section('script-libs')
    <script>
        function toggleStatusForm(orderId) {
            const form = document.getElementById(`status-form-${orderId}`);
            if (form.classList.contains('show')) {
                form.classList.remove('show');
                form.classList.add('hide');
                setTimeout(() => {
                    form.style.display = 'none';
                }, 300);
            } else {
                form.style.display = 'block';
                setTimeout(() => {
                    form.classList.remove('hide');
                    form.classList.add('show');
                }, 10);
            }
        }
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successAlert = document.getElementById('success-alert');
            var errorAlert = document.getElementById('error-alert');

            if (successAlert) {
                successAlert.classList.add('show');
                setTimeout(function() {
                    successAlert.classList.add('hide');
                    setTimeout(function() {
                        successAlert.remove(); // Xóa hoàn toàn sau khi hiệu ứng hoàn tất
                    }, 500); // Thời gian trễ để hiệu ứng hoàn tất
                }, 2000); // Hiển thị trong 2 giây
            }

            if (errorAlert) {
                errorAlert.classList.add('show');
                setTimeout(function() {
                    errorAlert.classList.add('hide');
                    setTimeout(function() {
                        errorAlert.remove(); // Xóa hoàn toàn sau khi hiệu ứng hoàn tất
                    }, 500); // Thời gian trễ để hiệu ứng hoàn tất
                }, 2000); // Hiển thị trong 2 giây
            }
        });
    </script> --}}

    {{-- <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}

    <!--datatable js-->
    {{-- <script src="{{ asset('https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script> --}}

    <!-- JAVASCRIPT -->
    {{-- <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script> --}}

    <!-- list.js min js -->
    {{-- <script src="{{ asset('assets/libs/list.js/list.min.js') }}"></script>

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
    <script src="{{ asset('assets/js/app.js') }}"></script> --}}
    <script>
        DataTable('#example', {
            order: [
                [0, 'desc']
            ]
        });
    </script>
    {{-- <script>
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
    </script> --}}
@endsection
