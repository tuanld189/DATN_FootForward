{{-- @extends('admin.layout.master') --}}
@extends('admin.layout.master')
@section('title')
    List Category Product
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý</a></li>
                        <li class="breadcrumb-item active">Danh mục</li>
                        <li class="breadcrumb-item active">Danh sách danh mục</li>
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
                    <h5 class="card-title mb-0">Danh mục</h5>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-2 w-10">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead class="text-muted table-light">
                            <tr>
                                <th scope="col" style="width: 10px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th data-ordering="false">ID</th>
                                <th>Tên danh mục</th>
                                <th>Ảnh</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            @forelse ($data as $item)
                                <tr>
                                    <td scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                                value="option1">
                                        </div>
                                    </td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <img src="{{ $item->image }}" alt="" width="100px">
                                    </td>
                                    <td>{!! $item->is_active ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                                    <td>
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            data-bs-placement="top" title="View">
                                            <a href="{{ route('admin.categories.show', $item->id) }}"
                                                class="text-primary d-inline-block">
                                                <i class="ri-eye-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            data-bs-placement="top" title="Edit">
                                            <a href="{{ route('admin.categories.edit', $item->id) }}"
                                                class="text-primary d-inline-block edit-item-btn">
                                                <i class="ri-pencil-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            data-bs-placement="top" title="Remove">
                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('admin.categories.destroy', $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="#" class="text-danger d-inline-block"
                                                onclick="event.preventDefault(); if(confirm('Bạn có muốn xóa không')) document.getElementById('delete-form-{{ $item->id }}').submit();">
                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                            </a>
                                        </li>
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


@endsection
