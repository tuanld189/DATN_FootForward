@extends('admin.layout.master')

@section('title')
    List Product Clusters
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                        <li class="breadcrumb-item active">Product Clusters</li>
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
                    <h5 class="card-title mb-0">Product Clusters</h5>
                    <a href="{{ route('admin.product-clusters.create') }}" class="btn btn-primary mb-2 w-10">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th data-ordering="false">ID</th>
                                <th>NAME</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th>ACTION</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clusters as $cluster)
                                <tr>
                                    <td scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                        </div>
                                    </td>
                                    <td>{{ $cluster->id }}</td>
                                    <td>{{ $cluster->name }}</td>
                                    <td>{{ $cluster->created_at }}</td>
                                    <td>{{ $cluster->updated_at }}</td>
                                    <td>
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            data-bs-placement="top" title="View">
                                            <a href="{{ route('admin.product-clusters.show', $cluster->id) }}"
                                                class="text-primary d-inline-block">
                                                <i class="ri-eye-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            data-bs-placement="top" title="Edit">
                                            <a href="{{ route('admin.product-clusters.edit', $cluster->id) }}"
                                                class="text-primary d-inline-block edit-item-btn">
                                                <i class="ri-pencil-fill fs-16"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            data-bs-placement="top" title="Remove">
                                            <form action="{{ route('admin.product-clusters.destroy', $cluster->id) }}" method="POST" onsubmit="return confirm('Bạn có muốn xóa không?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0"><i class="ri-delete-bin-5-fill fs-16"></i></button>
                                            </form>
                                        </li>
                                    </td>
                                    <!-- <td>
                                        <div style="max-width: 500px;">
                                            @foreach ($cluster->products as $product)
                                                <span class="badge bg-info" style="display: block; margin-bottom: 5px;">{{ $product->name }}</span>
                                                <img src="{{ Storage::url($product->image) }}" alt="" width="100px">
                                                @endforeach
                                        </div>
                                    </td> -->


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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

    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#example')) {
                $('#example').DataTable().destroy();
            }
            $('#example').DataTable({
                order: [[0, 'desc']]
            });
        });
    </script>
@endsection
