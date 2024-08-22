@extends('admin.layout.master')
@section('title')
    User Details
@endsection
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>User Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Fullname:</strong> {{ $user->fullname }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Phone:</strong> {{ $user->phone }}</p>
                    <p><strong>User Code:</strong> {{ $user->user_code }}</p>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Status:</strong> {{ $user->status }}</p>
                    <p><strong>Active:</strong> {{ $user->is_active ? 'Yes' : 'No' }}</p>
                    <p><strong>Province:</strong> {{ $user->province->name ?? 'Không có giá trị' }}</p>
                    <p><strong>District:</strong> {{ $user->district->name ?? 'Không có giá trị' }}</p>
                    <p><strong>Ward:</strong> {{ $user->ward->name ?? 'Không có giá trị' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Roles:</strong></p>
                    <ul>
                        @foreach ($user->roles as $role)
                            <li>{{ $role->name }}</li>
                        @endforeach
                    </ul>
                    <p><strong>Photo:</strong></p>
                    <img src="{{ Storage::url($user->photo_thumbs) }}" alt="User Photo" width="100">
                </div>
            </div>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
