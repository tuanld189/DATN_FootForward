@extends('admin.layout.master')
@section('title')
    List Category Product
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
                    <h5 class="card-title mb-0">Galleries</h5>
                    <a href="{{ route('admin.products.galleries.create', ['productId' => $product->id]) }}" class="btn btn-primary mb-2 w-10">Thêm mới</a>
                </div>
                <div class="card-body">
                    <h2 style="color:rgb(78, 218, 14); font-weght:50px;font-family: Arial, sans-serif;">Product: {{ $product->name }}</h2>
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                {{-- <th data-ordering="false">SR No.</th> --}}
                                <th data-ordering="false">ID</th>
                                    <th>IMAGE</th>
                                    <th>CREATE_AT</th>
                                    <th>UPDATE_AT</th>
                                    <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                                value="option1">
                                        </div>
                                    </td>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        <img src="{{ Storage::url($item->image) }}" alt="" width="100px">
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td>
                                        <a href="{{ route('admin.products.galleries.show', ['productId' => $product->id, 'id' => $item->id]) }}" class="btn btn-info mb-2 mt-2">Chi tiết</a> <br>
                                        <a href="{{ route('admin.products.galleries.edit', ['productId' => $product->id, 'id' => $item->id]) }}" class="btn btn-warning mb-2 mt-2">Sửa</a> <br>
                                        <a href="{{ route('admin.products.galleries.destroy', ['productId' => $product->id, 'id' => $item->id]) }}" class="btn btn-danger mb-2 mt-2"
                                           onclick="return confirm('Chắc chắn chưa')">Xóa</a> <br>
                                    </td>
                                </tr>
                            @endforeach
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
