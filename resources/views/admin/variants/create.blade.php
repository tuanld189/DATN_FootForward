@extends('admin.layout.master')
@section('title', 'Add New Variant')
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>
<h2>Product: {{ $product->name }}</h2>
<form action="{{ route('admin.products.variants.store', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 mt-3">
                <label for="product_size_id" class="form-label">Size: </label>
                <select name="product_size_id" id="product_size_id" class="form-select" aria-label="Default select example">
                    @foreach ($sizes as $id => $value)
                        <option value="{{ $id }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="product_color_id" class="form-label">Color: </label>
                <select name="product_color_id" id="product_color_id" class="form-select" aria-label="Default select example">
                    @foreach ($colors as $id => $value)
                        <option value="{{ $id }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity">
            </div>
            <div class="mb-3 mt-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
        </div>
    </div>
    <button type="submit" class="mt-3 btn btn-primary">Submit</button>
</form>
<a href="{{ route('admin.products.variants.index', $product->id) }}" class="btn btn-warning mt-3">BACK TO LIST</a>
@endsection
