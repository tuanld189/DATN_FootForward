@extends('admin.layout.master')
@section('title', 'Show Variant')
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Product: {{ $product->name }}</h5>
        <p class="card-text">Size: {{ $variant->size->name }}</p>
        <p class="card-text">Color: {{ $variant->color->name }}</p>
        <p class="card-text">Quantity: {{ $variant->quantity }}</p>
        <p class="card-text">
            Image:
            @if($variant->image)
                <img src="{{ Storage::url($variant->image) }}" alt="variant image" width="200px">
            @endif
        </p>

    </div>
</div>
<a href="{{ route('admin.products.variants.index', $product->id) }}" class="btn btn-primary">Back to List</a>

@endsection
