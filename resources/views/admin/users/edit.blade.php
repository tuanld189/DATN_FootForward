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
                <h4 class="mb-0">Quản lý</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý</a></li>
                        <li class="breadcrumb-item active">Người dùng</li>
                        <li class="breadcrumb-item active">Chỉnh sửa</li>
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
                                <!-- Role Selection -->
                                <div class="mb-3 mt-3">
                                    <label for="role_id">Vai trò</label>
                                    <select name="roles[]" class="form-control" id="roles" multiple required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Name, Email, Phone, User Code, Username, Password Fields -->
                                <div class="mb-3 mt-3">
                                    <label for="name">Tên</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $user->name }}">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ $user->email }}">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="phone">SDT</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        value="{{ $user->phone }}">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="user_code">Mã người dùng</label>
                                    <input type="text" name="user_code" id="user_code" class="form-control"
                                        value="{{ $user->user_code }}">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="username">Tên tài khoản</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        value="{{ $user->fullname }}">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    <small>Leave blank if you don't want to change the password</small>
                                </div>

                                <!-- Photo Upload -->
                                <div class="mb-3 mt-3">
                                    <label for="photo_thumbs">Ảnh</label>
                                    <input type="file" name="photo_thumbs" id="photo_thumbs" class="form-control">
                                    <img src="{{ Storage::url($user->photo_thumbs) }}" alt="User Photo" width="100">
                                </div>


                                <!-- Province, District, and Ward Selection -->
                                <div class="mb-3 mt-3">
                                    <label for="province_code">Tỉnh</label>
                                    <select name="province_code" id="province_code" class="form-control">
                                        <option value="">Chọn Tỉnh</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->code }}"
                                                {{ $user->province_code == $province->code ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="district_code">Huyện</label>
                                    <select name="district_code" id="district_code" class="form-control">
                                        <option value="">Chọn Huyện</option>
                                        <!-- Districts will be populated dynamically based on selected province -->
                                    </select>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="ward_code">Xã</label>
                                    <select name="ward_code" id="ward_code" class="form-control">
                                        <option value="">Chọn Xã</option>
                                        <!-- Wards will be populated dynamically based on selected district -->
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Is Active Checkbox -->
                                <div class="mb-3 mt-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active"
                                            value="1" {{ $user->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
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
            function populateDistricts(province_code) {
                if (province_code) {
                    $.ajax({
                        url: '{{ route('admin.users.get.districts', ':province_code') }}'.replace(
                            ':province_code', province_code),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#district_code').empty().append('<option value="">Chọn Huyện</option>');
                            $('#ward_code').empty().append('<option value="">Chọn Xã</option>');
                            $.each(data, function(key, value) {
                                $('#district_code').append('<option value="' + value.code +
                                    '">' + value.name + '</option>');
                            });

                            // Pre-select district if user has it
                            @if ($user->district_code)
                                $('#district_code').val('{{ $user->district_code }}').trigger(
                                'change');
                            @endif
                        }
                    });
                } else {
                    $('#district_code').empty().append('<option value="">Chọn Huyện</option>');
                    $('#ward_code').empty().append('<option value="">Chọn Xã</option>');
                }
            }

            function populateWards(district_code) {
                if (district_code) {
                    $.ajax({
                        url: '{{ route('admin.users.get.wards', ':district_code') }}'.replace(
                            ':district_code', district_code),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#ward_code').empty().append('<option value="">Chọn Xã</option>');
                            $.each(data, function(key, value) {
                                $('#ward_code').append('<option value="' + value.code + '">' +
                                    value.name + '</option>');
                            });

                            // Pre-select ward if user has it
                            @if ($user->ward_code)
                                $('#ward_code').val('{{ $user->ward_code }}');
                            @endif
                        }
                    });
                } else {
                    $('#ward_code').empty().append('<option value="">Chọn Xã</option>');
                }
            }

            // Load districts and wards on page load if province is already selected
            var initialProvince = '{{ $user->province_code }}';
            if (initialProvince) {
                populateDistricts(initialProvince);
            }

            // Update districts and wards on province change
            $('#province_code').change(function() {
                var province_code = $(this).val();
                populateDistricts(province_code);
            });

            // Load wards on district change
            $('#district_code').change(function() {
                var district_code = $(this).val();
                populateWards(district_code);
            });
        });
    </script>
@endsection
