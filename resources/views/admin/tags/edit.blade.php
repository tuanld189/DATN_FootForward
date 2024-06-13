@extends('admin.layout.master')
@section('title')
    Update Brand's Product: {{$model->namne}}
@endsection
@section('content')
    <form action="{{route('admin.tags.update',$model->id)}}" method="POST" enctype="multipart/form-data">
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
<br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
