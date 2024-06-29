@extends('admin.layout.master')

@section('title', 'Sale Detail')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">SALE DETAIL</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sales.index') }}">Sales</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"><b>SALE DETAIL PRODUCT : {{ $sale->products->pluck('name')->implode(', ') }}</b></h5>
                <a href="{{ route('admin.sales.index') }}" class="btn btn-primary mb-2">Back to List</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $sale->id }}</td>
                    </tr>
                    <tr>
                        <th>Products</th>
                        <td>{{ $sale->products->pluck('name')->implode(', ') }}</td>
                    </tr>
                    <tr>
                        <th>Sale Price</th>
                        <td>{{ $sale->sale_price }}</td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td>{{ $sale->start_date }}</td>
                    </tr>
                    <tr>
                        <th>End Date</th>
                        <td>{{ $sale->end_date }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{!! $sale->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $sale->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $sale->updated_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div><!-- end col -->
</div><!-- end row -->
@endsection
