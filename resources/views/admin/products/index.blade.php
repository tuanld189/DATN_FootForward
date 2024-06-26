@extends('admin.layout.master')
@section('title')
    List Product
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




                {{-- test --}}
                {{-- <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-6">
                                <div class="search-box">
                                    <input type="text" name="name" id="name" value="{{ request('name') }}"
                                        class="form-control search" placeholder="Search">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-6">
                                <div>
                                    <input type="date" class="form-control"  name="date_from" id="date_from"
                                    value="{{ request('date_from') }}">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices data-choices-search-false name="status_order"
                                        id="status_order">
                                        <option value="">All</option>
                                        @foreach (\App\Models\Order::STATUS_ORDER as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ request('status_order') == $key ? 'selected' : '' }}>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <select class="form-control" data-choices data-choices-search-false
                                        name="status_payment" id="status_payment">
                                        <option value="">All</option>
                                        @foreach (\App\Models\Order::STATUS_PAYMENT as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ request('status_payment') == $key ? 'selected' : '' }}>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <button type="submit" class="btn btn-primary w-100" onclick="SearchData();"> <i
                                            class="ri-equalizer-fill me-1 align-bottom"></i>
                                        Filters
                                    </button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div> --}}

                {{-- test --}}
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Products</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                </div>

                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('admin.products.index') }}" method="GET" class="my-4">
                            <div class="row">
                                <div class="col-md-2 mb-0">

                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ request('name') }}" placeholder="Name">
                                </div>

                                <div class="col-md-2 mb-0">

                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">-- All Category --</option>
                                        @foreach ($categories as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ request('category_id') == $id ? 'selected' : '' }}>{{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 mb-0">

                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option value="">-- All Brand --</option>
                                        @foreach ($brands as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ request('brand_id') == $id ? 'selected' : '' }}>
                                                {{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="col-md-2 mb-0">

                                    <input type="date" name="date_from" id="date_from" class="form-control"
                                        value="{{ request('date_from') }}">
                                </div>

                                <div class="col-md-2 mb-0">

                                    <input type="date" name="date_to" id="date_to" class="form-control"
                                        value="{{ request('date_to') }}">
                                </div>

                                <div class="col-md-2 mb-0">
                                    <button type="submit" class="btn btn-primary btn-block w-100">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                        <thead class="text-muted table-light gap-3">
                            <tr class="text-uppercase">
                                {{-- <th scope="col" style="width: 10px;">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th> --}}

                                <th>ID: </th>
                                <th>THUMBNAIL </th>
                                <th>NAME </th>
                                <th>SKU </th>
                                <th>SLUG </th>
                                <th>CATEGORY </th>
                                <th>BRAND </th>
                                <th>PRICE </th>
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
                        </thead>
                        <tbody class="list form-check-all">
                            @foreach ($data as $item)
                                <tr>
                                    {{-- <td scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                            value="option1">
                                    </div>
                                </td> --}}
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @php
                                            $url = $item->img_thumbnail;
                                            if (!Str::contains($url, 'http')) {
                                                $url = Storage::url($url);
                                            }
                                        @endphp

                                        <img src="{{ $url }}" alt="" width="80px">
                                    </td>

                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->brand->name }}</td>
                                    {{-- <td>{{ $item->category }}</td> --}}
                                    {{-- <td>{{ $item->brand }}</td> --}}
                                    <td>{{ $item->price }}</td>
                                    {{-- <td>{{$item->content}}</td>
                                <td>{{$item->description}}</td> --}}
                                    <td>
                                        @foreach ($item->tags as $tag)
                                            <span class="badge bg-info">{{ $tag->name }}</span>
                                        @endforeach


                                    </td>

                                    <td>{!! $item->is_active ? '<span class="badge bg-warning">ON</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                                    <td>{!! $item->is_hot_deal ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                                    <td>{!! $item->is_new ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                                    <td>{!! $item->is_show_home
                                        ? '<span class="badge bg-success">Yes</span>'
                                        : '<span class="badge bg-danger">No</span>' !!}</td>

                                    {{-- <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td> --}}

                                    <td>
                                        <ul class="list-inline hstack gap-1 mb-0">
                                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                data-bs-placement="top" title="View">
                                                <a href="{{ route('admin.products.show', $item->id) }}"
                                                    class="text-primary d-inline-block">
                                                    <i class="ri-eye-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                <a href="{{ route('admin.products.edit', $item->id) }}"
                                                    class="text-primary d-inline-block edit-item-btn">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                data-bs-placement="top" title="Remove">
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('admin.products.destroy', $item->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="text-danger d-inline-block"
                                                    onclick="event.preventDefault(); if(confirm('Bạn có muốn xóa không')) document.getElementById('delete-form-{{ $item->id }}').submit();">
                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                </a>
                                            </li>
                                    </td>
                                    </ul>

                                    </td>
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


    <!-- list.js min js -->
    <script src="assets/libs/list.js/list.min.js"></script>

    <!--list pagination js-->
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>

    <!-- ecommerce-order init js -->
    <script src="assets/js/pages/ecommerce-order.init.js"></script>

    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script>
        DataTable('#example', {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
