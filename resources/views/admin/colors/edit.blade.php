@extends('admin.layout.master')
@section('title')
@endsection
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image">Update Color Product: {{$model->namne}}</h3>
    <form action="{{route('admin.colors.update',$model->id)}}" method="POST" enctype="multipart/form-data">
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
                <div class="mb-3 mt-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <img src="{{\Storage::url($model->image)}}" alt="" width="100px">
                </div>
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
