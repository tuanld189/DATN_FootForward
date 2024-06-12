blade
Sao chép mã
@extends('admin.layout.master')
@section('title')
    Detail Product Gallery: {{ $model->id }}
@endsection
@section('content')
<h2>Product: {{ $product->name }}</h2>
    <table class="table">
        <tr>
            <th>Trường</th>
            <th>Giá trị</th>
        </tr>
        @foreach ($model->toArray() as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>
                    @if ($key == 'image')
                        <img src="{{ \Storage::url($value) }}" alt="" width="100px">
                    @else
                        {{ $value }}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('admin.products.galleries.index', ['productId' => $product->id]) }}" class="btn btn-warning mt-3">BACK TO LIST</a>
@endsection
