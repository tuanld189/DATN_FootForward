@extends('admin.layout.master')
@section('title', 'Add New User')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-0">Quản lý</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý</a></li>
                        <li class="breadcrumb-item active">Người dùng</li>
                        <li class="breadcrumb-item active">Thêm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Các trường khác -->
                        <div class="mb-3 mt-3">
                            <label for="roles">Vai trò</label>
                            <select name="roles[]" class="form-control" id="roles" multiple required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <div class="form-group">
                                <label for="fullname">Tên</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <div class="form-group">
                                <label for="fullname">Họ và tên</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <div class="form-group">
                                <label for="phone">SĐT</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <div class="form-group">
                                <label for="user_code">Mã người dùng</label>
                                <input type="text" name="user_code" id="user_code" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <div class="form-group">
                                <label for="photo_thumbs">Ảnh</label>
                                <input type="file" name="photo_thumbs" id="photo_thumbs" class="form-control" required>
                            </div>
                        </div>
                        {{-- <div class="mb-3 mt-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <textarea name="status" class="form-control" id="status" cols="30" rows="10" required></textarea>
                            </div>
                        </div> --}}

                        <!-- New fields for Province, District, and Ward -->
                        <div class="mb-3 mt-3">
                            <label for="province_code">Province</label>
                            <select name="province_code" id="province_code" class="form-control" required>
                                <option value="">Select Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->code }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="district_code">District</label>
                            <select name="district_code" id="district_code" class="form-control" required>
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="ward_code">Ward</label>
                            <select name="ward_code" id="ward_code" class="form-control" required>
                                <option value="">Select Ward</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 mt-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1">
                                    <label class="form-check-label" for="is_active">Is Active</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function generateRandomUserCode(length) {
                var result = '';
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            }

            $('#user_code').val(generateRandomUserCode(10));

            $('#province_code').change(function() {
                var province_code = $(this).val();
                if (province_code) {
                    $.ajax({
                        url: '{{ route('admin.users.get.districts', ':province_code') }}'.replace(':province_code', province_code),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#district_code').empty().append('<option value="">Select District</option>');
                            $('#ward_code').empty().append('<option value="">Select Ward</option>');
                            $.each(data, function(key, value) {
                                $('#district_code').append('<option value="' + value.code + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#district_code').empty().append('<option value="">Select District</option>');
                    $('#ward_code').empty().append('<option value="">Select Ward</option>');
                }
            });

            $('#district_code').change(function() {
                var district_code = $(this).val();
                if (district_code) {
                    $.ajax({
                        url: '{{ route('admin.users.get.wards', ':district_code') }}'.replace(':district_code', district_code),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#ward_code').empty().append('<option value="">Select Ward</option>');
                            $.each(data, function(key, value) {
                                $('#ward_code').append('<option value="' + value.code + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#ward_code').empty().append('<option value="">Select Ward</option>');
                }
            });
        });
    </script>
@endsection
