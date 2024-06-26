@extends('admin.layout.master')
@section('title')
    Edit User
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-0">Database</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                        <li class="breadcrumb-item active">Users</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="role_id">Role</label>
                                    <select name="roles[]" class="form-control" id="roles" multiple required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 mt-3">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            value="{{ $user->phone }}">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <div class="form-group">
                                        <label for="user_code">User Code</label>
                                        <input type="text" name="user_code" id="user_code" class="form-control"
                                            value="{{ $user->user_code }}">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                            value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                        <small>Leave blank if you don't want to change the password</small>
                                    </div>
                                </div>

                                <div class="mb-3 mt-3">
                                    <div class="form-group">
                                        <label for="photo_thumbs">Photo</label>
                                        <input type="file" name="photo_thumbs" id="photo_thumbs" class="form-control">
                                        <img src="{{ Storage::url($user->photo_thumbs) }}" alt="User Photo" width="100">
                                    </div>
                                </div>

                                <div class="mb-3 mt-3">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <textarea name="status" class="form-control" id="" cols="30" rows="10">{{ $user->status }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active"
                                            value="1" {{ $user->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
