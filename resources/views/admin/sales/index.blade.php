@extends('admin.layout.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Sales</h3>
            <div class="card-tools">
                <a href="{{ route('admin.sales.create') }}" class="btn btn-primary">Add New Sale</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Products</th>
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
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sale->products->pluck('name')->implode(', ') }}</td>
                            <td>{{ $sale->sale_price }}</td>
                            <td>{{ $sale->start_date }}</td>
                            <td>{{ $sale->end_date }}</td>
                            <td> {!! $sale->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                            <td>
                                <a href="{{ route('admin.sales.show', $sale->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('admin.sales.edit', $sale->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.sales.destroy', $sale->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
