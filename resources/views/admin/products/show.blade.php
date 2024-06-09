@extends('admin.layout.master')
@section('title')
    Detail Product: {{ $model->name }}
@endsection
@section('content')
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
                    @elseif ($key == 'category_id')
                        {{ $model->category->name }}
                    @elseif ($key == 'brand_id')
                        {{ $model->brand->name }}
                    @elseif (Str::contains($key, 'is_'))
                        {!! $value ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}
                    @else
                        {{ $value }}
                    @endif
                </td>
            </tr>
        @endforeach

    </table>
     <a href="{{ route('admin.brands.index') }}" class="btn btn-warning mt-3">BACK TO LIST</a>

@endsection
