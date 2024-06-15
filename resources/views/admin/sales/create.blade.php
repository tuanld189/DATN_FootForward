@extends('admin.layout.master')

@section('content')
<div class="container">
    <h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image">CREATE SALE PRODUCT</h3>
    <form action="{{ route('admin.sales.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="product_id">Product:</label>
            <select class="form-control" id="product_id" name="product_id" required>
                @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            @error('product_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="sale_price">Sale Price:</label>
            <input type="text" class="form-control" id="sale_price" name="sale_price" required>
            @error('sale_price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="start_date">Start Date:</label>
            <input type="date" class="form-control" id="start_date" name="start_date">
            @error('start_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="end_date">End Date:</label>
            <input type="date" class="form-control" id="end_date" name="end_date">
            @error('end_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <div class="mb-3 mt-3">
                <label class="form-check-label" for="status">
                    <input class="form-check-input" type="checkbox" value="1" checked name="status"> Status
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create Sale</button>
    </form>
    <a href="{{ route('admin.sales.index') }}" class="btn btn-success mb-2 mt-3">Back to List</a>
</div>
@endsection
