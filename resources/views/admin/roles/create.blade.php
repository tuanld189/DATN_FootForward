@extends('admin.layout.master')
@section('title')
    Create Role
@endsection
@section('content')
    <h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img
            src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>

    <form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="role" class="form-label">Role:</label>
                    @foreach ($permissions as $permission)
                        <div>
                            <input type="checkbox" id="permission-{{ $permission->id }}" name="permissions[]"
                                value="{{ $permission->id }}">
                            <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                </div>
                <div class="mb-3 mt-3">
                    <label for="description" class="form-label">Description:</label><br>
                    <textarea id="description" class="form-control" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" checked name="is_active">Is Active
                    </label>
                </div>

            </div>


        </div>


    </form>
@endsection
