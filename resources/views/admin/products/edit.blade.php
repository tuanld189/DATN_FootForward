

@extends('admin.layout.master')
@section('title')
    UPDATE PRODUCT: {{$model->name}}
@endsection
@section('content')
<form action="{{route('admin.products.update',$model->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="row">
            <div class="col-md-6">

                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" value="{{$model->name}}" name="name">
                </div>
                <div class="mb-3 mt-3">
                    <label for="description" class="form-label">Description:</label> <br>
                    <textarea name="description" id="description" cols="58" rows="4"  ">{{$model->description}}</textarea>

                </div>
                <div class="mb-3 mt-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <img src="{{Storage::url($model->image)}}" alt="" width="100px">

                </div>
                <div class="mb-3 mt-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control" id="price" value="{{$model->price}}" placeholder="Enter price" name="price">
                </div>
                <div class="mb-3 mt-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" value="{{$model->quantity}}" placeholder="Enter quantity" name="quantity">
                </div>
                <div class="mb-3 mt-3">
                    <label for="content" class="form-label">Content:</label>
                    <input type="text" class="form-control" id="content" value="{{$model->content}}" placeholder="Enter content" name="content">
                </div>
            </div>
            <div class="col-md-6" >
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1"
                        @if ($model->status)
                        checked
                        @endif
                    checked name="status">Status
                    </label>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1"
                        @if ($model->is_hot_deal)
                            checked
                        @endif
                         checked name="is_hot_deal">Is_Hot_Deal
                    </label>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1"
                        @if ($model->is_new)
                        checked
                        @endif
                         checked name="is_new">Is_New
                    </label>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1"
                        @if ($model->is_show_home)
                        checked
                        @endif
                         checked name="is_show_home">Is_Show_Home
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="mt-3 btn btn-primary">Update</button>
    </form>
    <a href="{{ route('admin.products.index') }}" class="btn btn-warning mt-3">BACK TO LIST</a>

@endsection
