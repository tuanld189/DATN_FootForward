@extends('admin.layout.master')
@section('title')
    Add New Product
@endsection
@section('content')
    <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="category_id" class="form-label">Category: </label>
                    <select name="category_id" id="category_id"  class="form-select" aria-label="Default select example">

                        @foreach ($categories as $id => $value )
                            <option value="{{$id}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="brand_id" class="form-label">Brand: </label>
                    <select name="brand_id" id="brand_id"  class="form-select" aria-label="Default select example">

                        @foreach ($brands as $id => $value )
                            <option value="{{$id}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div>
                <div class="mb-3 mt-3">
                    <label for="description" class="form-label">Description:</label> <br>
                    <textarea name="description" id="description" cols="58" rows="4"  placeholder="Enter description"></textarea>

                </div>
                <div class="mb-3 mt-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3 mt-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control" id="price" placeholder="Enter price" name="price">
                </div>
                <div class="mb-3 mt-3">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity">
                </div>
                <div class="mb-3 mt-3">
                    <label for="content" class="form-label">Content:</label>
                    <input type="text" class="form-control" id="content" placeholder="Enter content" name="content">
                </div>
            </div>
            <div class="col-md-6" >
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" checked name="status">Status
                    </label>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" checked name="is_hot_deal">Is_Hot_Deal
                    </label>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" checked name="status">Is_New
                    </label>
                </div>
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" checked name="status">Is_Show_Home
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="mt-3 btn btn-primary">Submit</button>
    </form>
    <a href="{{ route('admin.products.index') }}" class="btn btn-warning mt-3">BACK TO LIST</a>

@endsection
