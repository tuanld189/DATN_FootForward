@extends('admin.layout.master')
@section('title')
    List Banner
@endsection
@section('style-libs')
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Quản lý</a></li>
                        <li class="breadcrumb-item active">Banner</li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- end page title -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Banner</h5>
                    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width: 100%">
                        <thead class="text-muted table-light">
                            <tr>
                                <th scope="col" style="width: 25px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Active</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            @forelse ($data as $item)
                                <tr>
                                    <td style="width: 25px;">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" value="option">
                                        </div>
                                    </td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <img src="{{ $item->image }}" alt="Banner Image" width="100px" height="50px">
                                    </td>
                                    <td>
                                        {!! $item->is_active ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}
                                    </td>
                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item" data-bs-toggle="tooltip" title="View">
                                                <a href="{{ route('admin.banners.show', $item->id) }}" class="text-primary">
                                                    <i class="ri-eye-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item" data-bs-toggle="tooltip" title="Edit">
                                                <a href="{{ route('admin.banners.edit', $item->id) }}" class="text-primary">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item" data-bs-toggle="tooltip" title="Remove">
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('admin.banners.destroy', $item->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Bạn có muốn xóa không?')) document.getElementById('delete-form-{{ $item->id }}').submit();">
                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-warning text-center m-0">
                                            Không có dữ liệu nào trong danh sách.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div><!-- end row -->
@endsection



@section('script-libs')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTable JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
@endsection
