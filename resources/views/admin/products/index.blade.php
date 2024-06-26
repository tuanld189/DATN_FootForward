@extends('admin.layout.master')
@section('title')
    List Product
@endsection

@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Products</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lí sản phẩm</a></li>
                    <li class="breadcrumb-item active">Products</li>
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
                    <h5 class="card-title mb-0">Products</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <tr>
                            <th scope="col" style="width: 10px;">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th>
                            </th>
                            <th>ID</th>
                            <th>THUMBNAIL</th>
                            <th>NAME</th>
                            <th>SKU</th>
                            <th>SLUG</th>
                            <th>CATEGORY</th>
                            <th>BRAND</th>
                            <th>PRICE</th>
                            {{-- <th>SHORT CONTENT</th>
                            <th>DESCRIPTION</th> --}}
                            <th>TAGS</th>
                            <th>ACTIVE</th>
                            <th>HOT_DEAL</th>
                            <th>NEW</th>
                            <th>SHOW_HOME</th>
                            {{-- <th>CREATE AT</th>
                            <th>UPDATE AT</th> --}}
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
                                <td>{{$item->id}}</td>
                                <td>
                                    @php
                                        $url = $item->img_thumbnail;
                                        if(!Str::contains($url,'http')){
                                            $url = Storage::url($url);
                                        }
                                    @endphp

                                    <img src="{{$url}}" alt="" width="100px">
                                </td>

                                <td>{{$item->name}}</td>
                                <td>{{$item->sku}}</td>
                                <td>{{$item->slug}}</td>
                                <td>{{$item->category->name}}</td>
                                <td>{{$item->brand->name}}</td>
                                <td>{{$item->price}}</td>
                                {{-- <td>{{$item->content}}</td>
                                <td>{{$item->description}}</td> --}}
                                <td>
                                    @foreach ($item->tags as $tag )
                                        <span class="badge bg-info">{{$tag->name}}</span>
                                    @endforeach


                                </td>

                                <td >{!!$item->is_active? '<span class="badge bg-warning">ON</span>'
                                :'<span class="badge bg-danger">No</span>' !!}</td>
                                <td>{!!$item->is_hot_deal ? '<span class="badge bg-success">Yes</span>'
                                :'<span class="badge bg-danger">No</span>' !!}</td>
                                <td>{!!$item->is_new ? '<span class="badge bg-success">Yes</span>'
                                :'<span class="badge bg-danger">No</span>' !!}</td>
                                <td>{!!$item->is_show_home ? '<span class="badge bg-success">Yes</span>'
                                :'<span class="badge bg-danger">No</span>' !!}</td>

                                {{-- <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td> --}}

                                <td>
                                    <a href="{{ route('admin.products.show',$item->id) }}" class="btn btn-info mb-2 mt-2">Detail</a> <br>
                                    <a href="{{ route('admin.products.edit',$item->id) }}" class="btn btn-warning mb-2 mt-2">Edit</a> <br>
                                    <form action="{{route('admin.products.destroy',$item)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('Chắc chắn xóa !')"
                                            type="submit" class="btn btn-danger"
                                        >
                                            DELETE
                                        </button>
                                    </form>


                                </td>
                            </tr>
                        @endforeach
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

