@extends('admin.layout.master')

@section('title')
    Detail Category: {{ $model->name }}
@endsection

@section('content')
    <h3 style="font-weight: bold; font-size: 40px; font-family: Times New Roman, serif;">
        <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Icon"> @yield('title')
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

    <br>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-warning">Back to list</a>
@endsection
