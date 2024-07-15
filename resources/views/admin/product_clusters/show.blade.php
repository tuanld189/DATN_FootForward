@extends('admin.layout.master')

@section('title', 'Detail Product Cluster')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Detail Product Cluster</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.product-clusters.index') }}">Product Clusters</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Product Cluster Detail</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Cluster Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ $productCluster->name }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="products" class="col-sm-2 col-form-label">Products:</label>
                            <div class="col-sm-10">
                                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th>NAME</th>
                                            <th>IMAGE</th>
                                            <th>CREATED AT</th>
                                            <th>UPDATED AT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productCluster->products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>
                                                    @php
                                                        $url = $product->img_thumbnail;
                                                        if (!Str::contains($url, 'http')) {
                                                            $url = Storage::url($url);
                                                        }
                                                    @endphp
                                                    <img src="{{ $url }}" alt="" width="50px">
                                                </td>
                                                <td>{{ $product->created_at }}</td>
                                                <td>{{ $product->updated_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>              
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <a href="{{ route('admin.product-clusters.edit', $productCluster->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('admin.product-clusters.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
