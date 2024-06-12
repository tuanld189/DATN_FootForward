@extends('admin.layout.master')
@section('title')
    Update Category: {{$model->name}}
@endsection
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>
    <form action="{{route('admin.categories.update',$model->id)}}" method="POST" enctype="multipart/form-data">
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
                    @if($model->image)
                        <img src="{{ asset('storage/' . $model->image) }}" alt="Current Image" style="max-height: 100px;">
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1"
                        @if ($model->is_active)
                            checked
                        @endif
                        checked name="is_active">Is Active
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
