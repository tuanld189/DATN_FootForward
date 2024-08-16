@extends('admin.layout.master')
@section('title', 'Orders Status')

{{-- @if (session('success') || session('error'))
    <div class="alert-container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
@endif --}}

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Trạng thái đơn hàng</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trạng thái đơn hàng</a></li>
                        <li class="breadcrumb-item active">Đơn hàng</li>
                        <li class="breadcrumb-item active">Trạng thái đơn hàng</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- <style>
        /* Style cho alert-container */
        .alert-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1050;
            width: 300px;
        }

        /* Cơ bản cho các alert */
        .alert {
            border: 1px solid transparent;
            border-radius: .25rem;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .alert.show {
            opacity: 1;
        }

        .alert.hide {
            opacity: 0;
        }

        /* Alert thành công */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        /* Alert lỗi */
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        /* Icon trong alert */
        .alert-icon {
            font-size: 1.25rem;
            margin-right: .5rem;
        }

        /* Thay đổi cho các button trạng thái */
        .btn-outline-primary.active {
            background-color: #0d6efd;
            color: #fff;
            border-color: #0d6efd;
        }
    </style> --}}

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- @if (session('success') || session('error'))
        <div class="alert-container">
            @if (session('success'))
                <div id="success-alert" class="alert alert-success show">
                    <div class="alert-content">
                        <i class="ri-check-line alert-icon"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div id="error-alert" class="alert alert-danger show">
                    <div class="alert-content">
                        <i class="ri-close-line alert-icon"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif
        </div>
    @endif --}}




    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center mt-2">
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

                <!-- All Status Button -->
                <a href="{{ route('admin.orders.status') }}" class="btn btn-outline-secondary me-2 mb-2">
                    <i class="fas fa-list me-1"></i> Tất cả
                </a>

                <!-- Status Buttons -->
                @foreach (\App\Models\Order::STATUS_ORDER as $key => $status)
                    <a href="{{ route('admin.orders.status', ['status_order' => $key]) }}"
                        class="btn btn-outline-primary me-2 mb-2 {{ request('status_order') == $key ? 'active' : '' }}">
                        <i class="{{ $statusIcons[$key] }} me-1"></i> {{ $status }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Trạng thái đươn hàng</h4>
                    <form action="{{ route('admin.orders.update_multiple') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status_order" value="{{ request('status_order') }}">
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;"><input type="checkbox" id="checkAll"></th>
                                        <th>Mã đơn hàng</th>
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
                                            <td>{{ $order->order_code }}</td>
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
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                {{ $orders->links('pagination::bootstrap-4') }}
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light mb-4">
                                    Cập nhật trạng thái
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('script-libs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successAlert = document.getElementById('success-alert');
            var errorAlert = document.getElementById('error-alert');

            if (successAlert) {
                setTimeout(function() {
                    successAlert.classList.add('hide');
                    setTimeout(function() {
                        successAlert.remove(); // Xóa hoàn toàn sau khi hiệu ứng hoàn tất
                    }, 500); // Thời gian trễ để hiệu ứng hoàn tất
                }, 2000); // Hiển thị trong 2 giây
            }

            if (errorAlert) {
                setTimeout(function() {
                    errorAlert.classList.add('hide');
                    setTimeout(function() {
                        errorAlert.remove(); // Xóa hoàn toàn sau khi hiệu ứng hoàn tất
                    }, 500); // Thời gian trễ để hiệu ứng hoàn tất
                }, 2000); // Hiển thị trong 2 giây
            }
        });
    </script>
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
@endsection --}}
