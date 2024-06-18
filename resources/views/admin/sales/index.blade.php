@extends('admin.layout.master')


@section('content')
    <div class="">
        <h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> SALE PRODUCT</h3>
        <a href="{{ route('admin.sales.create') }}" class="btn btn-primary mb-3">Create Sale</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Sale Price</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->sale_price }}</td>
                        <td>{{ $sale->start_date }}</td>
                        <td>{{ $sale->end_date }}</td>
                        <td>{!!$sale->status? '<span class="badge bg-warning">Active</span>'
                                :'<span class="badge bg-danger">Inactive</span>' !!} </td>
                        <td>
                            <a href="{{ route('admin.sales.show', $sale->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('admin.sales.edit', $sale->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('admin.sales.destroy', $sale->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sale?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
