@extends('admin.layout.master')

@section('content')
<div class="container">
    <h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> EDIT SALE PRODUCT</h3>
    <form action="{{ route('admin.sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Các trường dữ liệu cần cập nhật -->
        <div class="form-group">
            <label for="product_id" class="form-label">Product:</label>
            <select name="product_id" id="product_id" class="form-select">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $sale->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="sale_price">Sale Price:</label>
            <input type="text" class="form-control" id="sale_price" name="sale_price" value="{{ $sale->sale_price }}" required>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $sale->start_date }}">
        </div>

        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $sale->end_date }}">
        </div>



        <button type="submit" class="btn btn-primary">Update Sale</button>
    </form>
    <a href="{{ route('admin.sales.index') }}" class="btn btn-success mb-2 mt-3">Back to List</a>

</div>

@endsection
