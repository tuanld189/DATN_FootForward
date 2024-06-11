blade
Sao chép mã
@extends('admin.layout.master')
@section('title')
    Add New Product Gallery
@endsection
@section('content')
<h2>Product: {{ $product->name }}</h2>
    <form action="{{ route('admin.products.galleries.store', ['productId' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 mt-3">
            <label for="images" class="form-label">Images:</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
        </div>
        <button type="submit" class="mt-3 btn btn-primary">Submit</button>
    </form>
    <a href="{{ route('admin.products.galleries.index', ['productId' => $product->id]) }}" class="btn btn-warning mt-3">BACK TO LIST</a>
@endsection
