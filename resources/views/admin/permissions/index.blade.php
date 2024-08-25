@extends('admin.layout.master')
@section('title')
    List Permission
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý</a></li>
                        <li class="breadcrumb-item active">Permission</li>
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
                    <h5 class="card-title mb-0">Permission</h5>
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="100%">
                        <thead class="text-muted table-light">
                            <tr>
                                <th scope="col" style="width: 10px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                {{-- <th>CREATE_AT</th>
                            <th>UPDATE_AT</th> --}}
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">

                            @foreach ($permissions as $permission)
                                <tr>
                                    <td scope="col" style="width: 10px;">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                                value="option">
                                        </div>
                                    </td>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        {{ $permission->description }}
                                    </td>
                                    <td>
                                        <input type="checkbox" class="toggle-status" data-id="{{ $permission->id }}"
                                            {{ $permission->is_active ? 'checked' : '' }}>
                                    </td>
                                    {{-- <td>{{ $permission->created_at }}</td>
                                <td>{{ $permission->updated_at }}</td> --}}
                                    <td>
                                        {{-- <ul class="list-inline hstack gap-2 mb-0"> --}}
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            data-bs-placement="top" title="View">
                                            <a href="{{ route('admin.permissions.show', $permission->id) }}"
                                                class="text-primary d-inline-block">
                                                <i class="ri-eye-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            data-bs-placement="top" title="Edit">
                                            <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                class="text-primary d-inline-block edit-item-btn">
                                                <i class="ri-pencil-fill fs-16"></i>
                                            </a>
                                        </li>

                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            data-bs-placement="top" title="Remove">
                                            <form id="delete-form-{{ $permission->id }}"
                                                action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <a href="#" class="text-danger d-inline-block"
                                                onclick="event.preventDefault(); if(confirm('Bạn có muốn xóa không')) document.getElementById('delete-form-{{ $permission->id }}').submit();">
                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                            </a>
                                        </li>
                                        {{-- </ul> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $permission->links() }} --}}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.toggle-status').change(function() {
                var isActive = $(this).prop('checked') ? 1 : 0;
                var permissionId = $(this).data('id');

                $.ajax({
                    url: '{{ route('admin.permissions.toggleStatus') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: permissionId,
                        is_active: isActive
                    },
                    success: function(response) {
                        console.log('Trạng thái đã được cập nhật');
                    },
                    error: function(xhr) {
                        console.log('Cập nhật thất bại');
                    }
                });
            });
        });
    </script>
@endsection
