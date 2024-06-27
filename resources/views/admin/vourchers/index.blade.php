@extends('admin.layout.master')
@section('title')
    Vourcher
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
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Vourchers</h5>
                    <a href="{{ route('admin.vourchers.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                    {{-- <a href="{{ route('admin.vouchers.create') }}" class="nav-link" data-key="t-horizontal">Thêm mới</a> --}}
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mã Voucher</th>
                                <th>Loại Giảm Giá</th>
                                <th>Giá Trị Giảm Giá</th>
                                <th>Mô tả</th>
                                <th>Ngày Bắt Đầu</th>
                                <th>Ngày Kết Thúc</th>
                                <th>Trạng Thái</th>
                                <th>Số Lượng Còn Lại</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vourchers as $voucher)
                                <tr>
                                    <td>{{ $voucher->code }}</td>
                                    <td>{{ ucfirst($voucher->discount_type) }}</td>
                                    {{-- <td>{{$voucher->formatted_discount, 0, ',', '.'}}</td> --}}
                                    <td>{{number_format($voucher->discount_value, 0, ',', '.' )}}</td>
                                    <td>{{ $voucher->description }}</td>
                                    <td>{{ $voucher->start_date }}</td>
                                    <td>{{ $voucher->end_date }}</td>
                                    <td>{!! $voucher->is_active
                                        ? '<span class="badge bg-success">Hoạt động</span>'
                                        : '<span class="badge bg-danger">Không hoạt động</span>' !!}</td>
                                    <td>{{ $voucher->quantity }}</td>
                                    <td>
                                        <a href="{{ route('admin.vourchers.show', $voucher->id) }}"
                                            class="btn btn-primary btn-sm">Xem</a>
                                        <a href="{{ route('admin.vourchers.edit', $voucher->id) }}"
                                            class="btn btn-info btn-sm">Chỉnh Sửa</a>
                                        <form action="{{ route('admin.vourchers.destroy', $voucher->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $vourchers->links() }}
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
    <script>
        DataTable('#example', {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
