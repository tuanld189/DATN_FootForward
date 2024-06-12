@extends('admin.layout.master')
@section('title')
    Detail Category: {{$model->name}}
@endsection
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>
    <table class="table">
        <tr>
            <th>Trường</th>
            <th>Giá trị</th>
        </tr>
        @foreach ($model->toArray() as $key=>$value)
        <tr>
            <td>{{$key}}</td>
            <td>
                @php
                    if($key == 'image'){
                        $url=\Storage::url($value);
                        echo "<img src=\" $url\" alt=\"$url\" width=\"100px\">";

                    }elseif (Str::contains($key,'is_')) {
                        echo $value
                        ? '<span class="badge bg-success">Yes</span>'
                        :'<span class="badge bg-danger">No</span>' ;
                    }
                    else {
                        echo $value;
                    }
                @endphp
            </td>
        </tr>
        @endforeach

    </table>
    <br>
    <button class="btn-warning">
        <a  href="{{ route('admin.categories.index') }}">Back to list</a>
    </button>

@endsection
