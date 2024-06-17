@extends('admin.layout.master')
@section('title')
    Add New User
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="role_id">Role</label>
                    <select name="roles[]" class="form-control" id="roles" multiple required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 mt-3">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <div class="form-group">
                        <label for="user_code">User Code</label>
                        <input type="text" name="user_code" id="user_code" class="form-control">
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <div class="form-group">
                        <label for="photo_thumbs">Photo</label>
                        <input type="file" name="photo_thumbs" id="photo_thumbs" class="form-control">
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <div class="form-group">
                        <label for="status">Status</label>
                       <textarea name="status" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1">
                        <label class="form-check-label" for="is_active">Is Active</label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
