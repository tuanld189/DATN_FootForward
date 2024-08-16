@extends('admin.layout.master')

@section('title')
    Detail Brand's Product: {{ $model->name }}
@endsection

@section('content')
    <h3 style="font-weight: bold; font-size: 40px; font-family: Times New Roman, serif;">
        <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')
    </h3>

    <table class="table">
        <tr>
            <th>Trường</th>
            <th>Giá trị</th>
        </tr>
        @foreach ($model->toArray() as $key => $value)
            <tr>
                <td>{{ $key }}</td>
                <td>
                    @if($key === 'image')
                        @php
                            $url = $value;
                            if (!Str::startsWith($url, 'http')) {
                                $url = Storage::url($url);
                            }
                        @endphp
                        <img src="{{ $url }}" alt="Product Image" width="100px">
                    @elseif(Str::startsWith($key, 'is_'))
                        <span class="badge {{ $value ? 'bg-success' : 'bg-danger' }}">
                            {{ $value ? 'Yes' : 'No' }}
                        </span>
                    @else
                        {{ $value }}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-primary mt-3">Back to List</a>
@endsection
