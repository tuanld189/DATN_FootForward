@extends('admin.layout.master')
@section('title', 'Edit Variant')
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>

<form action="{{ route('admin.products.variants.update', [$product->id, $variant->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 mt-3">
                <label for="product_size_id" class="form-label">Size: </label>
                <select name="product_size_id" id="product_size_id" class="form-select" aria-label="Default select example">
                    @foreach ($sizes as $id => $value)
                        <option value="{{ $id }}" {{ $variant->product_size_id == $id ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="product_color_id" class="form-label">Color: </label>
                <select name="product_color_id" id="product_color_id" class="form-select" aria-label="Default select example">
                    @foreach ($colors as $id => $value)
                        <option value="{{ $id }}" {{ $variant->product_color_id == $id ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" class="form-control" id="quantity" value="{{ $variant->quantity }}" name="quantity">
            </div>
            <div class="mb-3 mt-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($variant->image)
                    <img src="{{ Storage::url($variant->image) }}" alt="variant image" width="100px">
                @endif
            </div>
        </div>
    </div>
    <button type="submit" class="mt-3 btn btn-primary">Update</button>
</form>
<a href="{{ route('admin.products.variants.index', $product->id) }}" class="btn btn-warning mt-3">BACK TO LIST</a>
@endsection
