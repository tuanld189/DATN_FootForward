@extends('admin.layout.master')
@section('title')
    Update Permission
@endsection
@section('content')
<h3 style="font-weight: bold; font-size:40px;font-family: Times New Roman, serif;"> <img src="{{ asset('images/pin1.png') }}" width="40px" alt="Your Image"> @yield('title')</h3>

    <form action="{{route('admin.permissions.update',$role->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Tên:</label>
                    <input type="text" class="form-control" id="name"
                    value="{{$permission->name}}"
                    placeholder="Enter name" name="name">
                </div>
                <div class="mb-3 mt-3">
                    <label for="discription" class="form-label">Mô tả:</label>
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description', $permission->description) }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1"
                        @if ($permission->is_active)
                            checked
                        @endif
                        checked name="is_active">Is Active
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
