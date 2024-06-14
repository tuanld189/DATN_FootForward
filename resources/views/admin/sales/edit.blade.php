
@extends('admin.layout.master')
@section('content')
    <h1>Edit Sale</h1>
    <form action="{{ route('admin.products.sales.update', [$productId, $sale->id]) }}" method="POST"> <!-- Sửa route để chứa cả $productId -->
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="sale_price">Sale Price</label>
            <input type="text" name="sale_price" id="sale_price" class="form-control" value="{{ $sale->sale_price }}">
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $sale->start_date }}">
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $sale->end_date }}">
        </div>
        <div class="form-group">
           
        </div>
        <button type="submit" class="btn btn-primary">Update Sale</button>
    </form>
@endsection
