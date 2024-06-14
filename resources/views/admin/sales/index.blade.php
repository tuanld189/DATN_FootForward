php
Sao chép mã
@extends('admin.layout.master')

@section('content')

    <h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image">Sale for Product: {{ $product->name }}</h3>

    <a href="{{ route('admin.products.sales.create', $product->id) }}" class="btn btn-primary">Create Sale</a>

    <table class="table">

        <thead>
            <tr>
                <th>Sale Price</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($sales)
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->sale_price }}</td>
                    <td>{{ $sale->start_date }}</td>
                    <td>{{ $sale->end_date }}</td>

                    <td>{!! $sale->status ? '<span class="badge bg-warning">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                    <td>
                        <a href="{{ route('admin.products.sales.show', [$product->id, $sale->id]) }}" class="btn btn-success">Show</a>
                        <a href="{{ route('admin.products.sales.edit', [$product->id, $sale->id]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.products.sales.destroy', [$product->id, $sale->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @endif <!-- Thêm dòng này -->
        </tbody>
    </table>
@endsection
