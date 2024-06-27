@extends('admin.layout.master')

@section('title', "Create New Brand's Product")

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-0">Create New Brand's Product</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                        <li class="breadcrumb-item active">Brands</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12 ">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center font-weight-bold"
                        style="font-size: 40px; font-family: 'Times New Roman', serif;">
                        <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image">
                        Create New Brand's Product
                    </h3>

                    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="image" class="form-label">Image:</label>
                                    <input type="file" class="form-control" id="image" name="image" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group form-check mb-4">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                                    <label for="is_active" class="form-check-label">Is Active</label>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#lfm').filemanager('image');
        });
    </script>
@endsection
