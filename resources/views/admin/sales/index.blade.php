@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quản lý</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý</a></li>
                        <li class="breadcrumb-item active">Giảm giá</li>
                        <li class="breadcrumb-item active">Danh sách giảm giá</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách bán hàng</h3>
            <div class="card-tools">
                <a href="{{ route('admin.sales.create') }}" class="btn btn-primary">Thêm giảm giá mới</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-bordered">
                <thead class="text-muted table-light">
                    <tr>
                        <th>#</th>
                        <th>Sản phẩm</th>
                        <th>Sale giá</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody class="list form-check-all">
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @foreach ($sale->products as $product)
                                    <span class="badge bg-info">{{ $product->name }}</span>
                                    @if (!$loop->last)
                                        <br>
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ number_format($sale->sale_price, 0, ',', '.') }}</td>
                            <td>{{ $sale->start_date }}</td>
                            <td>{{ $sale->end_date }}</td>
                            <td> {!! $sale->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                            <td style="display: flex; justify-content:center; ">
                                <ul class="list-inline hstack gap-2 mb-0">
                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                        data-bs-placement="top" title="View">
                                        <a href="{{ route('admin.sales.show', $sale->id) }}"
                                            class="text-primary d-inline-block">
                                            <i class="ri-eye-fill fs-16"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                        data-bs-placement="top" title="Edit">
                                        <a href="{{ route('admin.sales.edit', $sale->id) }}"
                                            class="text-primary d-inline-block edit-item-btn">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item remove" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            data-bs-placement="top" title="Remove">
                                        <form action="{{ route('admin.sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Bạn có muốn xóa không?');" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0 m-0">
                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
