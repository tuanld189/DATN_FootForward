@extends('admin.layout.master')
@section('title')
    Thống kê chi tiết đơn hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thống kê chi tiết đơn hàng</h4>
            </div>
        </div>
    </div>

    <!-- Lọc theo thời gian -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.dashboard.OrderDetail') }}" method="GET" id="filter-form">
                <div>
                    <label for="filter">Lọc theo:</label>
                    <select name="filter" id="filter" onchange="toggleCustomDates()" class="form-control">
                        <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Hôm nay</option>
                        <option value="yesterday" {{ $filter == 'yesterday' ? 'selected' : '' }}>Hôm qua</option>
                        <option value="this_week" {{ $filter == 'this_week' ? 'selected' : '' }}>Tuần này</option>
                        <option value="this_month" {{ $filter == 'this_month' ? 'selected' : '' }}>Tháng này</option>
                        <option value="this_year" {{ $filter == 'this_year' ? 'selected' : '' }}>Năm này</option>
                        <option value="custom" {{ $filter == 'custom' ? 'selected' : '' }}>Tùy chọn</option>
                    </select>
                </div>

                <div id="custom-dates" style="display: {{ $filter == 'custom' ? 'block' : 'none' }};">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"  class="form-control">

                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"  class="form-control">
                </div>

                <button type="submit" class="btn btn-primary mt-2">Filter</button>
            </form>

            <!-- Thống kê -->
            <div class="row mt-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <h5 class="card-title mb-0">Tổng doanh thu</h5>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                {{ number_format($totalRevenueAll, 0, ',', '.') }} đ
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <h5 class="card-title mb-0">Số lượng hóa đơn</h5>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                {{ $totalOrders }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <h5 class="card-title mb-0">Số hóa đơn hủy</h5>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                {{ $totalCancelledOrders }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <h5 class="card-title mb-0">Số hóa đơn đã nhận hàng</h5>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                {{ $totalDeliveredOrders }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Biểu đồ doanh thu -->
            <div class="w-100 mt-3">
                <div id="revenue_chart" data-colors='["--vz-primary"]' class="apex-charts" dir="ltr"></div>
            </div>
            <div class="order-list">
                <h4>Danh sách đơn hàng</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Trạng thái</th>
                            <th>Địa chỉ</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->user_name }}</td>
                                <td>{{ $order->status_order }}</td>
                                <!-- Bạn có thể sử dụng hàm chuyển đổi trạng thái nếu cần -->
                                <td>{{ $order->ward->name ?? 'Không có giá trị' }},
                                    {{ $order->district->name ?? 'Không có giá trị' }},
                                    {{ $order->province->name ?? 'Không có giá trị' }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }} <!-- Phân trang -->
            </div>
        </div>
    </div>
@endsection

@section('script-libs')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Biểu đồ doanh thu
            var columnChartOptions = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Doanh thu',
                    data: @json($totalRevenuePerDay)
                }],
                xaxis: {
                    categories: @json($labels),
                    title: {
                        text: 'Khoảng thời gian'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Doanh thu'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#34c38f'],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    }
                },
            };

            var columnChart = new ApexCharts(document.querySelector("#revenue_chart"), columnChartOptions);
            columnChart.render();
        });

        function toggleCustomDates() {
            var filter = document.getElementById('filter').value;
            var customDates = document.querySelector('.custom-dates');

            if (filter === 'custom') {
                customDates.style.display = 'block';
            } else {
                customDates.style.display = 'none';
            }
        }
    </script>
@endsection
