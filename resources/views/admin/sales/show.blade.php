@extends('admin.layout.master')
@section('title')
    Detail Sale Product: {{ $model->id }}
@endsection
@section('content')

<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>

<table class="table">
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>ID</td>
        <td>{{ $model->id }}</td>
    </tr>
    <tr>
        <td>Product</td>
        <td>{{ $model->product->name }}</td>
    </tr>
    <tr>
        <td>Sale Price</td>
        <td>{{ $model->sale_price}}</td>
    </tr>
    <tr>
        <td>Start Date</td>
        <td>{{ $model->start_date }}</td>
    </tr>
    <tr>
        <td>End Date</td>
        <td>{{ $model->end_date }}</td>
    </tr>

    <tr>
        <td>Status</td>
        <td>{!! $model->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</td>
    </tr>
</table>
<a href="{{ route('admin.products.sales.index', $model->id) }}" class="btn btn-warning mt-3">BACK TO LIST</a>

@endsection
