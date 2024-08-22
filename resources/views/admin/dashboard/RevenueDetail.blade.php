@extends('admin.layout.master')
@section('title')
    Doanh thu tổng quan
@endsection
{{-- <style>
    .filter-form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-form .form-group {
        margin: 0;
    }

    .filter-form .form-group label {
        margin-right: 5px;
    }

    .filter-form .form-group select,
    .filter-form .form-group input {
        width: auto;
        max-width: 200px;
    }

    .filter-form .btn {
        margin-left: 10px;
    }

    .custom-dates {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .custom-dates label {
        margin-right: 5px;
    }

    .custom-dates input {
        max-width: 120px;
    }
</style> --}}

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>

                {{-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div> --}}

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">DOANH THU TỔNG QUAN</h5>
                </div>
                <div class="row mb-3">
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
                    {{-- <div class="col-lg-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <h5 class="card-title mb-0">Số lượng mặt hàng</h5>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    {{ $totalItems }}
                                </h4>
                            </div>
                        </div>
                    </div> --}}
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
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.dashboard.RevenueDetail') }}" class="filter-form">
                            <div class="form-group">
                                <label for="filter">Lọc theo:</label>
                                <select id="filter" name="filter" class="form-control">
                                    <option value="today" {{ request('filter') === 'today' ? 'selected' : '' }}>Ngày hôm
                                        nay</option>
                                    <option value="yesterday" {{ request('filter') === 'yesterday' ? 'selected' : '' }}>Ngày
                                        hôm qua</option>
                                    <option value="this_week" {{ request('filter') === 'this_week' ? 'selected' : '' }}>Tuần
                                        này</option>
                                    <option value="this_month" {{ request('filter') === 'this_month' ? 'selected' : '' }}>
                                        Tháng này</option>
                                    <option value="this_year" {{ request('filter') === 'this_year' ? 'selected' : '' }}>Năm
                                        này</option>
                                    <option value="custom" {{ request('filter') === 'custom' ? 'selected' : '' }}>Tùy chỉnh
                                    </option>
                                </select>
                            </div>
                            <div class="form-group custom-dates"
                                style="{{ request('filter') === 'custom' ? '' : 'display: none;' }}">
                                <label for="start_date">Từ ngày:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="{{ request('start_date') ?? now()->startOfMonth()->format('Y-m-d') }}">
                                <label for="end_date">Đến ngày:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="{{ request('end_date') ?? now()->endOfMonth()->format('Y-m-d') }}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Lọc</button>
                        </form>

                        <div class="w-100 mt-3">
                            <div id="revenue_chart" data-colors='["--vz-primary"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!-- end card body -->


                </div>
            </div><!--end col-->
        </div><!--end row-->
    @endsection

    @section('script-libs')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Revenue column chart
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
                        enabled: false // Ẩn số lượng trên các cột
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
        </script>
    @endsection
