@extends('admin.layout.master')
@section('title')
    Create Vourcher
@endsection
@section('content')
    <div class="container">
        <h1>Create Vourcher</h1>

        <!-- Hiển thị thông báo lỗi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.vourchers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" name="code" class="form-control" value="{{ old('code') }}" >
                @if ($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="discount">Discount</label>
                <input type="text" name="discount" class="form-control" value="{{ old('discount') }}" >
                @if ($errors->has('discount'))
                    <span class="text-danger">{{ $errors->first('discount') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" >
                @if ($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" >
                @if ($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select name="is_active" class="form-control" >
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @if ($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
