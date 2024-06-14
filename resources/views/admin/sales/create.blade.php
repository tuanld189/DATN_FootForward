@extends('admin.layout.master')
@section('content')
<div class="container">
    <h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> Create Sale for Product: {{ $product->name }}</h3>

  
    <form action="{{ route('admin.products.sales.store', $product->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="sale_price">Sale Price</label>
            <input type="text" name="sale_price" id="sale_price" class="form-control" value="{{ old('sale_price') }}">
            @error('sale_price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
            @error('start_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
            @error('end_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-3 mb-3">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" value="1" checked name="status"> Status
            </label>
            @error('status')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Sale</button>
    </form>
</div>
@endsection
