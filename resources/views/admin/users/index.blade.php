@extends('admin.layout.master')
@section('title')
    List User
@endsection
@section('content')
   <!-- start page title -->
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
                    <h5 class="card-title mb-0">User</h5>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <tr>
                            <th scope="col" style="width: 10px;">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Photo_thumbs</th>
                            <th>User_code</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>ACTION</th>
                        </tr>
                        @foreach ($data as $item)
                            <tr>
                                <td scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                            value="option1">
                                    </div>
                                </td>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <img src="{{ Storage::url($item->photo_thumbs) }}" alt="" width="100px">
                                </td>
                                <td>{{ $item->user_code }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->password }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    <a href="{{ route('admin.users.show', $item->id) }}" class="btn btn-info mb-2">Chi
                                        tiết</a>
                                    <a href="{{ route('admin.users.edit', $item->id) }}"
                                        class="btn btn-warning mb-2">Sửa</a>
                                    <a href="{{ route('admin.users.destroy', $item->id) }}" class="btn btn-danger mb-2"
                                        onclick="return confirm('Chắc chắn chưa')">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $data->links() }}
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
        DataTable('#example',{
           order: [ [0, 'desc'] ]
        });
    </script>
@endsection

