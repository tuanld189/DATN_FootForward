@extends('admin.layout.master')
@section('title')
    Create New Category
@endsection
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>

    <form action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div>
                <div class="mb-3 mt-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" checked name="is_active">Is Active
                    </label>
                </div>
            </div>
        </div>
<br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
