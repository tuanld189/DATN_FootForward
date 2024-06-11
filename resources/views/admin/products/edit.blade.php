

@extends('admin.layout.master')
@section('title')
    UPDATE PRODUCT: {{$model->name}}
@endsection
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>

<form action="{{route('admin.products.update',$model->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id">

                        @foreach ($categories as $id => $value )
                            <option
                            @if ($model->category_id == $id)
                                selected
                            @endif
                            value="{{$id}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="brand_id" class="form-label">Brand:</label>
                    <select name="brand_id" id="brand_id">

                        @foreach ($brands as $id => $value )
                            <option
                            @if ($model->brand_id == $id)
                                selected
                            @endif
                            value="{{$id}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="sku" class="form-label">Code Sku:</label>
                    <input type="text" class="form-control" id="sku" value="{{$model->sku}}" placeholder="Enter sku" name="sku">
                </div>
                <div class="mb-3 mt-3">
                    <label for="slug" class="form-label">Slug:</label>
                    <input type="text" class="form-control" id="slug" value="{{$model->slug}}"placeholder="Enter slug" name="slug">
                </div>
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" value="{{$model->name}}" name="name">
                </div>
                <div class="mb-3 mt-3">
                    <label for="content" class="form-label">Content:</label>
                    <input type="text" class="form-control" id="content" value="{{$model->content}}" placeholder="Enter content" name="content">
                </div>
                <div class="mb-3 mt-3">
                    <label for="img_thumbnail" class="form-label">Image Thumbnail:</label>
                    <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
                    <img src="{{Storage::url($model->img_thumbnail)}}" alt="" width="100px">
                </div>
                <div class="mb-3 mt-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control" id="price" value="{{$model->price}}" placeholder="Enter price" name="price">
                </div>
                <div class="mb-3 mt-3">
                    <label for="description" class="form-label">Description:</label> <br>
                    <textarea name="description" id="description" cols="58" rows="4"  ">{{$model->description}}</textarea>

                </div>
            </div>
            <div class="col-md-6" >
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1"
                        @if ($model->status)
                        checked
                        @endif
                    checked name="status"> Status
                    </label>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1"
                        @if ($model->is_hot_deal)
                            checked
                        @endif
                         checked name="is_hot_deal"> Hot_Deal
                    </label>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1"
                        @if ($model->is_new)
                        checked
                        @endif
                         checked name="is_new"> New
                    </label>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1"
                        @if ($model->is_show_home)
                        checked
                        @endif
                         checked name="is_show_home"> Show_Home
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="mt-3 btn btn-primary">Update</button>
    </form>
    <a href="{{ route('admin.products.index') }}" class="btn btn-warning mt-3">BACK TO LIST</a>

@endsection
