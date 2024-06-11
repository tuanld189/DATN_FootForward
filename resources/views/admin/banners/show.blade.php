@extends('admin.layout.master')
@section('title')
    Banner: {{$model->name}}
@endsection
@section('content')
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
                        echo "<img src=\" $url\" alt=\"\" width=\"100px\">";

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
@endsection
