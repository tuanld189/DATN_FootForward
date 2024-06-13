@extends('admin.layout.master')
@section('title')
    Create New Brand's Product
@endsection
@section('content')
    <form action="{{route('admin.tags.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div>
            </div>
        </div>
<br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
