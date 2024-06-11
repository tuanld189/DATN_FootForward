blade
Sao chép mã
@extends('admin.layout.master')
@section('title')
    Edit Product Gallery
@endsection
@section('content')
<h2 style="color:green">Product: {{ $product->name }}</h2>
    <form action="{{ route('admin.products.galleries.update', ['productId' => $product->id, 'id' => $model->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3 mt-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ Storage::url($model->image) }}" alt="" width="100px">
        </div>
        <button type="submit" class="mt-3 btn btn-primary">Submit</button>
    </form>
    <a href="{{ route('admin.products.galleries.index', ['productId' => $product->id]) }}" class="btn btn-warning mt-3">BACK TO LIST</a>
@endsection
