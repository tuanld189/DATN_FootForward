@extends('admin.layout.master')
@section('title')
    Create New Brand's Product
@endsection
@section('content')
    <h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;">
        <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image">
        @yield('title')
    </h3>

    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div>
                <div class="mb-3 mt-3">
                    <label for="image" class="form-label">Image:</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span>
                        <input id="image" class="form-control" type="text" name="image">
                    </div>
                    <img id="holder" style="margin-top:15px;max-height:100px;">
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

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#lfm').filemanager('image');
        });
    </script>
@endsection
