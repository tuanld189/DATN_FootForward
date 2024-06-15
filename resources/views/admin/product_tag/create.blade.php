@extends('admin.layout.master')
@section('title')
    Create New Brand's Product
@endsection
@section('content')
    <form action="{{route('admin.product_tag.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">

                <div class="mb-3 mt-3">
                    <label for="category_id" class="form-label">Tag: </label>
                    <select name="category_id" id="category_id"  class="form-select" aria-label="Default select example">

                        @foreach ($tag as $id => $value )
                            <option value="{{$id}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 mt-3">
                    <label for="category_id" class="form-label">Product: </label>
                    <select name="category_id" id="category_id"  class="form-select" aria-label="Default select example">

                        @foreach ($product as $id => $value )
                            <option value="{{$id}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div> --}}
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
