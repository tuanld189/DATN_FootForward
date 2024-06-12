@extends('admin.layout.master')
@section('title')
    Update Size Product: {{$model->namne}}
@endsection
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>
    <form action="{{route('admin.sizes.update',$model->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name"
                    value="{{$model->name}}"
                    placeholder="Enter name" name="name">
                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
