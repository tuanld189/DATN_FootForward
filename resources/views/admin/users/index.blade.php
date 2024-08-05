@extends('admin.layout.master')
@section('title', 'List User')

@section('content')
    <!-- start page title -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý</a></li>
                        <li class="breadcrumb-item active">Người dùng</li>
                        <li class="breadcrumb-item active">Danh sách người dùng</li>
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
                    <h5 class="card-title mb-0">Danh sách</h5>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-2">Thêm người dùng</a>
                </div>
                <form action="{{ route('admin.users.index') }}" method="GET" class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text" name="name" class="form-control" placeholder="Tên người dùng"
                                value="{{ request('name') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ request('email') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="date" class="form-control" placeholder="Ngày"
                                value="{{ request('date') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">Fillter</button>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped"
                        style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 10px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td scope="col" style="width: 10px;">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                                value="option">
                                        </div>
                                    </td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles->implode('name', ', ') }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                            class="btn btn-sm btn-info" data-bs-toggle="tooltip"
                                            title="View"><i class="ri-eye-fill"></i></a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-sm btn-warning" data-bs-toggle="tooltip"
                                            title="Edit"><i class="ri-pencil-fill"></i></a>
                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                data-bs-toggle="tooltip" title="Delete"><i
                                                    class="ri-delete-bin-5-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style-libs')
    <!-- Datatable CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
@endsection

@section('script-libs')
    <!-- Datatable JS -->
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [],
                "responsive": true,
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi trên mỗi trang",
                    "zeroRecords": "Không tìm thấy dữ liệu",
                    "info": "Hiển thị trang _PAGE_ của _PAGES_",
                    "infoEmpty": "Không có bản ghi nào",
                    "infoFiltered": "(được lọc từ tổng số _MAX_ bản ghi)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "previous": "Trước",
                        "next": "Tiếp theo"
                    }
                }
            });
        });
    </script>
@endsection
