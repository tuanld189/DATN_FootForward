@extends('admin.layout.master')

@section('title', 'Edit Product Cluster')
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>

    <form action="{{ route('admin.product-clusters.update', $productCluster->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 mr-3 ml-3">Cluster Name:</h5>
                    <input type="text" class="form-control mr-3 m-1" id="name" placeholder="Enter name" name="name" value="{{ $productCluster->name }}" style="flex-grow: 1;">
                    <button type="submit" class="btn btn-primary mr-1 ml-1" style="width: 100px;">Update</button>
                    <a href="{{ route('admin.product-clusters.index') }}" class="btn btn-secondary" style="width: 100px; margin-left: 5px;">Cancel</a>
                </div>
                    <div class="card-body">
                        <table id="example" class="table table-bordered dt-responsive  table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10px;">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th style="width:30%">PRODUCTS</th>
                                    <th>PRODUCTS IMAGE</th>
                                    <th>CREATED AT</th>
                                    <th>UPDATED AT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" id="product_{{ $product->id }}" name="products[]" value="{{ $product->id }}" 
                                            @if(in_array($product->id, $productCluster->products->pluck('id')->toArray())) checked @endif>
                                        </div>
                                    </td>
                                    <td>{{ $product->id }}</td>
                                    <td style="width:30%">{{ $product->name }}</td>
                                    <td>
                                        @php
                                            $url = $product->img_thumbnail;
                                            if (!Str::contains($url, 'http')) {
                                                $url = Storage::url($url);
                                            }
                                        @endphp
                                        <img src="{{ $url }}" alt="" width="100px">
                                    </td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>              
                    </div>
            </div>
        </div>

       
    </form>
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
        $(document).ready(function() {
            $('#example').DataTable({
                order: [
                    [0, 'desc']
                ]
            });
        });
    </script>
@endsection
