@extends('admin.layout.master')
@section('title')
    Detail Brand's Product: {{$model->name}}
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
            <td>{{ $value }}</td>
        </tr>
        @endforeach
    </table>
    <button class="btn-warning">
        <a  href="{{ route('admin.vourchers.index') }}">Back to list</a>
    </button>
@endsection
