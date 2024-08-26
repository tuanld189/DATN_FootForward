@extends('admin.layout.master')
@section('title')
    Thống kê chi tiết sản phẩm đã bán
@endsection

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
                    <h5 class="card-title mb-0">Thống kê chi tiết sản phẩm đã bán</h5>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <h5 class="card-title mb-0">Sản phẩm đã bán 1 tuần </h5>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    {{ $totalProductsWeek }} Sản phẩm
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <h5 class="card-title mb-0">Sản phẩm đã bán 1 tháng</h5>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    {{ $totalProductsMonth }} Sản phẩm
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <h5 class="card-title mb-0">Sản phẩm đã bán 1 năm</h5>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    {{ $totalProductsYear }} Sản phẩm
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <h5 class="card-title mb-0">Tổng sản phẩm đã bán</h5>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    {{ $totalProductsAll }} Sản phẩm
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="filter-buttons">
                        <a href="{{ route('admin.dashboard.ProductSoldDetail', ['filter' => '1day']) }}"
                            class="btn btn-primary">1
                            Ngày</a>
                        <a href="{{ route('admin.dashboard.ProductSoldDetail', ['filter' => '7days']) }}"
                            class="btn btn-primary">7
                            Ngày</a>
                        <a href="{{ route('admin.dashboard.ProductSoldDetail', ['filter' => '1month']) }}"
                            class="btn btn-primary">1
                            Tháng</a>
                        <a href="{{ route('admin.dashboard.ProductSoldDetail', ['filter' => '1year']) }}"
                            class="btn btn-primary">1
                            Năm</a>
                        <a href="{{ route('admin.dashboard.ProductSoldDetail', ['filter' => 'all']) }}"
                            class="btn btn-primary">Tất
                            cả</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">

                            {{-- <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="100%"> --}}
                            {{-- <thead class="text-muted table-light"> --}}
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col" style="width: 10px;">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                                value="option">
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Mã Sản Phẩm</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Ngày Bán</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @if ($soldProducts->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">Không có sản phẩm nào</td>
                                    </tr>
                                @else
                                    @foreach ($soldProducts as $product)
                                        <tr>
                                            <td scope="col" style="width: 10px;">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                                        value="option">
                                                </div>
                                            </td>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->product_sku }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->quantity_add }}</td>
                                            <!-- or whatever field stores the quantity sold -->
                                            <td>{{ $product->created_at }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <a href="{{ route('admin.dashboard') }}"><button class="btn btn-primary" style="float: right">Quay
                                lại</button></a>
                        {{ $data->links() }}
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
@endsection
