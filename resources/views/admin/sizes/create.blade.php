@extends('admin.layout.master')
@section('title')
    Create New Size Product
@endsection
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>
    <form action="{{route('admin.sizes.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
