@extends('admin.layout.master')
@section('title')
    Create Vourcher
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                        <li class="breadcrumb-item active">Vouchers</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xxl-12 ">
            <div class="card">
                <div class="card-body">
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
                                <label for="code">Mã Voucher:</label>
                                <input type="text" id="code" name="code" class="form-control"
                                    value="{{ old('code') }}">
                                @if ($errors->has('code'))
                                    <span class="text-danger">{{ $errors->first('code') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="discount_type">Loại Giảm Giá:</label>
                                <select name="discount_type" id="discount_type" class="form-control">
                                    <option value="">--Chọn--</option>
                                    <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>
                                        Phần trăm (%)
                                    </option>
                                    <option value="amount" {{ old('discount_type') == 'amount' ? 'selected' : '' }}>Giá tiền
                                    </option>
                                </select>
                                @if ($errors->has('discount_type'))
                                    <span class="text-danger">{{ $errors->first('discount_type') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả:</label>
                                <input type="text" id="description" name="description" class="form-control"
                                    value="{{ old('description') }}">
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="discount_value">Giá trị Giảm Giá:</label>
                                <input type="number" id="discount_value" name="discount_value" class="form-control"
                                    value="{{ old('discount_value') }}">
                                @if ($errors->has('discount_value'))
                                    <span class="text-danger">{{ $errors->first('discount_value') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="start_date">Ngày Bắt Đầu:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="{{ old('start_date') }}">
                                @if ($errors->has('start_date'))
                                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="end_date">Ngày Kết Thúc:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="{{ old('end_date') }}">
                                @if ($errors->has('end_date'))
                                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="is_active">Trạng Thái:</label>
                                <select name="is_active" id="is_active" class="form-control">
                                    <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Hoạt động
                                    </option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Không hoạt động
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Số Lượng:</label>
                                <input type="number" id="quantity" name="quantity" class="form-control"
                                    value="{{ old('quantity', 1) }}" min="1">
                                @if ($errors->has('quantity'))
                                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                @endif
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Tạo Voucher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
