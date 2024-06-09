@extends('admin.layout.master')
@section('title')
    Update Brand's Product: {{$model->namne}}
@endsection
@section('content')
    <form action="{{route('admin.brands.update',$model->id)}}" method="POST" enctype="multipart/form-data">
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
