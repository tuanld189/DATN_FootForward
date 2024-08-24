@extends('client.layouts.master')
@section('title', 'Trang chủ')


@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
    <style>
        .overflow {
            width: 1050px;
            height: 500px;
            overflow: auto;
        }

        .order-Products {
            padding: 20px;
            margin: 20px auto;
            max-width: 1000px;
        }

        .text-center {
            text-align: center;
            margin-bottom: 20px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .product-table th,
        .product-table td {
            padding: 10px;
            text-align: center;
            /* Căn giữa nội dung */
        }

        .product-table th {
            font-weight: bold;
        }

        .product-table tr:hover {
            background-color: #f1f1f1;
        }

        .shoe-image {
            width: 100px;
            height: auto;
        }

        .nav-success.nav-tabs .nav-link.active {
            color: #8a8f6a;
        }

        .profile-pic {
            position: relative;
            display: inline-block;
            width: 200px;
            height: 200px;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-pic .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
            border-radius: 50%;
        }

        .profile-pic:hover .overlay {
            opacity: 2;
        }

        .profile-pic .overlay label {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            border-radius: 98px;
            background-color: rgba(206, 212, 218, 0.2);
        }

        .btn-primary:hover {
            border-radius: 98px;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .btn-danger {
            border: 1px solid #8a8f6a;
            border-radius: 20px;
        }

        .text-right {
            text-align: right;
            padding: 20px 80px 20px 20px;
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            list-style-type: none;
            padding: 0;
        }

        .step-indicator li {
            text-align: center;
            flex: 1;
            position: relative;
        }

        .step-indicator li::before,
        .step-indicator li::after {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 2px;
            width: 100%;
            background-color: #ccc;
            z-index: -1;
        }

        .step-indicator li::before {
            left: 50%;
        }

        .step-indicator li::after {
            right: 50%;
        }

        .step-indicator li:first-child::before,
        .step-indicator li:last-child::after {
            display: none;
        }

        .step-indicator li .step {
            width: 24px;
            height: 24px;
            line-height: 24px;
            border-radius: 50%;
            background-color: #ccc;
            color: #fff;
            display: inline-block;
            margin-bottom: 10px;
        }

        .step-indicator li.completed .step {
            background-color: #8a8f6a;
        }

        .step-indicator li.active .step {
            background-color: #8a8f6a;
            border: 1px solid #8a8f6a;
        }

        #openPopupBtn {
            padding: 10px 20px;
            font-size: 16px;
        }

        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .popup-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 1000px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: popup-animation 0.4s;
            border-radius: 10px;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @keyframes popup-animation {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-table th,
        .order-table td {
            box-shadow: white;
            padding: 8px;
            text-align: center;
            /* Căn giữa nội dung */
        }

        .order-table th {
            font-weight: bold;
        }

        .order-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .order-table tr:hover {
            background-color: #f1f1f1;
        }

        .status.unpaid {
            color: #e74c3c;
            font-weight: bold;
        }

        .status.unpaid::before {
            content: '• ';
            color: #e74c3c;
        }

        .view-details {
            padding: 10px;
            border-radius: 10px;
            background-color: #8a8f6a;
            color: white;
            font-weight: bold;
        }

        .b-cancle {
            padding: 10px;
            border-radius: 10px;
            background-color: rgb(153, 7, 7);
            color: white;
            font-weight: bold;
        }

        td {
            background-color: rgba(7, 166, 198, 0.1);
        }

        .custom-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .custom-modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 20px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

@endsection
@section('content')

    <div class="product-content mt-2 " style="margin-bottom:50px;">
        <div class="container">

            <h2 class="text-center">THÔNG TIN HỒ SƠ CỦA TÔI</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <nav>
                <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="nav-additional-tab" data-bs-toggle="tab" href="#nav-additional"
                            role="tab" aria-controls="nav-additional" aria-selected="true">Hồ sơ của tôi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" href="#nav-detail" role="tab"
                            aria-controls="nav-detail" aria-selected="false">Chi tiết</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-order-tab" data-bs-toggle="tab" href="#nav-order" role="tab"
                            aria-controls="nav-order" aria-selected="false">Trạng thái đơn hàng</a>
                    </li>
                </ul>
            </nav>

            <div class="tab-content border border-top-0 p-4 shadow-lg pb-4"
                style="margin: 30px 10px;background-color: #8a8f6a4a;
    border-radius: 10px;" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-additional" role="tabpanel"
                    aria-labelledby="nav-additional-tab">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="profile-pic text-center">
                                <img id="profileImage"
                                    src="{{ Auth::check() && Auth::user()->photo_thumbs ? Storage::url(Auth::user()->photo_thumbs) : asset('assets/images/banner/Avatardf.jpg') }}"
                                    class="img-fluid rounded-circle shadow" alt="Profile Picture">
                                <h3 class="font-weight-bold mt-3 ">{{ old('fullname', $user->fullname) }}</h3>
                                <h5 class="text-muted">{{ old('email', $user->email) }}</h5>
                                <div class="overlay">
                                    <label for="photoInput" class="btn-primary text-white text-xxl">Thay đổi ảnh</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <form action="{{ route('client.profile.update', ['id' => $user->id]) }}" method="POST"
                                enctype="multipart/form-data" class="p-4">
                                @csrf
                                @method('PUT')
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width: 200px;">Tên đầy đủ:</th>
                                                <td><input type="text" class="form-control" id="fullname"
                                                        name="fullname" value="{{ old('fullname', $user->fullname) }}"
                                                        required
                                                        style="border: 1px solid white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email:</th>
                                                <td><input type="email" class="form-control" id="email" name="email"
                                                        value="{{ old('email', $user->email) }}" required
                                                        style="border: 1px solid white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Số điện thoại:</th>
                                                <td><input type="text" class="form-control" id="phone" name="phone"
                                                        value="{{ old('phone', $user->phone) }}" required
                                                        style="border: 1px solid white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tỉnh:</th>
                                                <td>
                                                    <select class="form-control" id="province_code" name="province_code"
                                                        required>
                                                        <option value="">Chọn Tỉnh</option>
                                                        @foreach ($provinces as $province)
                                                            <option value="{{ $province->code }}"
                                                                {{ old('province_code', $user->province_code) == $province->code ? 'selected' : '' }}>
                                                                {{ $province->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Huyện:</th>
                                                <td>
                                                    <select class="form-control" id="district_code" name="district_code"
                                                        data-selected="{{ old('district_code', $user->district_code) }}"
                                                        required>
                                                        <option value="">Chọn Huyện</option>
                                                        <!-- Các huyện sẽ được điền bởi AJAX -->
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Xã:</th>
                                                <td>
                                                    <select class="form-control" id="ward_code" name="ward_code"
                                                        data-selected="{{ old('ward_code', $user->ward_code) }}" required>
                                                        <option value="">Chọn Xã</option>
                                                        <!-- Các xã sẽ được điền bởi AJAX -->
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Ảnh:</th>
                                                <td><input type="file" class="form-control" id="photoInput"
                                                        name="photo_thumbs"
                                                        style="border: 1px solid white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn rounded-5 mt-3">Sửa hồ sơ</button>
                                <button type="button" class="btn btn-warning rounded-5 mt-3"
                                    id="openChangePasswordModal">Thay đổi mật khẩu</button>
                            </form>
                        </div>

                        <!-- Custom Modal -->
                        <div id="changePasswordModal" class="custom-modal">
                            <div class="custom-modal-content">
                                <span class="close" id="closeChangePasswordModal">&times;</span>
                                <form id="ajax-change-password-form" method="POST"
                                    action="{{ route('client.profile.change-password.update', ['id' => $user->id]) }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="current_password">Mật khẩu cũ</label>
                                        <input type="password" class="form-control" id="current_password"
                                            name="current_password" required
                                            style="border: 1px solid white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">Mật khẩu mới</label>
                                        <input type="password" class="form-control" id="new_password"
                                            name="new_password" required
                                            style="border: 1px solid white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                                        <input type="password" class="form-control" id="new_password_confirmation"
                                            name="new_password_confirmation" required
                                            style="border: 1px solid white;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    </div>
                                    <button type="submit" class="btn rounded-5 mt-3">Thay đổi mật khẩu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                    <div>
                        <h5 class="font-size-16 mb-3">Patterns arts & culture</h5>
                        <p>Cultural patterns are the similar behaviors within similar situations we witness due to shared
                            beliefs, values, norms and social practices that are steady over time. In art, a pattern is a
                            repetition of specific visual elements. The dictionary.com definition of "pattern" is: an
                            arrangement of repeated or corresponding parts, decorative motifs, etc.</p>
                        <div>
                            <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> On
                                digital
                                or printed media</p>
                            <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> For
                                commercial and personal projects</p>
                            <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> From
                                anywhere in the world</p>
                            <p class="mb-0"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> Full
                                copyrights sale</p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
                    <div class=" p-4 overflow">
                        <table class="order-table text-center">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>MÃ ĐƠN HÀNG</th>
                                    <th>NGÀY TẠO</th>
                                    {{-- <th>KHÁCH HÀNG</th>
                        <th>SDT</th> --}}
                                    <th>TỔNG TIỀN</th>
                                    <th>TRẠNG THÁI ĐƠN HÀNG</th>
                                    <th>TRẠNG THÁI THANH TOÁN</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($orders as $index => $order)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $order->order_code }}</td>
                                        <td>{{ $order->created_at->format('d-m-Y H:i:s') }}</td>
                                        {{-- <td>{{ $order->user_name }}</td>
                            <td>{{ $order->user_phone }}</td> --}}
                                        <td>{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td class="status-badge">
                                            {{ \App\Models\Order::STATUS_ORDER[$order->status_order] }}
                                        </td>
                                        <td class="status-badge">
                                            {{ \App\Models\Order::STATUS_PAYMENT[$order->status_payment] }}
                                        </td>
                                        <td>
                                            <a href="#" class="view-details "
                                                data-order-id="{{ $order->id }}">Chi Tiết</a>
                                            <!-- Existing buttons -->
                                            @if ($order->status_order === 'pending')
                                                <form action="{{ route('order.cancel', $order->id) }}" method="POST"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn mt-2 b-cancle">Hủy</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div id="popup" class="popup" style="display: none;">
                            <div class="popup-content">
                                <span class="close-btn">&times;</span>
                                <div class="order-info">
                                    <!-- Order details will be loaded here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection

        @section('scripts')
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> --}}
            {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
            <script>
                $(document).ready(function() {
                    // Show the modal
                    $('#openChangePasswordModal').click(function() {
                        $('#changePasswordModal').css('display', 'block');
                    });

                    // Hide the modal
                    $('#closeChangePasswordModal').click(function() {
                        $('#changePasswordModal').css('display', 'none');
                        resetChangePasswordForm();
                    });

                    // Hide the modal when clicking outside of the modal content
                    $(window).click(function(event) {
                        if ($(event.target).is('#changePasswordModal')) {
                            $('#changePasswordModal').css('display', 'none');
                            resetChangePasswordForm();
                        }
                    });

                    // AJAX form submission for password change
                    $('#ajax-change-password-form').submit(function(event) {
                        event.preventDefault();

                        $.ajax({
                            url: $(this).attr('action'),
                            method: 'POST',
                            data: $(this).serialize(),
                            success: function(response) {
                                alert('Thay đổi mật khau thành công!');
                                $('#changePasswordModal').css('display', 'none');
                                resetChangePasswordForm();
                            },
                            error: function(xhr) {
                                alert('Thay đổi mật khẩu thất bai: ' + xhr.responseText);
                                resetChangePasswordForm();
                            }
                        });
                    });

                    function resetChangePasswordForm() {
                        $('#ajax-change-password-form')[0].reset();
                    }
                });
                // Hiển thị ảnh đại diện khi thay đổi
                document.getElementById('photoInput').onchange = function(evt) {
                    const [file] = evt.target.files;
                    if (file) {
                        document.getElementById('profileImage').src = URL.createObjectURL(file);
                    }
                };

                // Khi nhấn nút "Xem Chi Tiết", thực hiện AJAX để lấy thông tin đơn hàng
                document.querySelectorAll('.view-details').forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        const orderId = this.dataset.orderId;

                        fetch(`/profile/order/${orderId}`)
                            .then(response => response.text())
                            .then(html => {
                                document.querySelector('#popup .order-info').innerHTML = html;
                                document.getElementById('popup').style.display = 'block';
                            });
                    });
                });

                $(document).ready(function() {
                    function populateDistricts(province_code) {
                        if (province_code) {
                            $.ajax({
                                url: '{{ route('get.districts', ':province_code') }}'.replace(':province_code',
                                    province_code),
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
                                    var selectedDistrict = $('#district_code').data('selected');
                                    if (selectedDistrict) {
                                        $('#district_code').val(selectedDistrict).trigger('change');
                                    }
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
                                url: '{{ route('get.wards', ':district_code') }}'.replace(':district_code',
                                    district_code),
                                type: 'GET',
                                dataType: 'json',
                                success: function(data) {
                                    $('#ward_code').empty().append('<option value="">Chọn Xã</option>');
                                    $.each(data, function(key, value) {
                                        $('#ward_code').append('<option value="' + value.code + '">' +
                                            value.name + '</option>');
                                    });

                                    // Pre-select ward if user has it
                                    var selectedWard = $('#ward_code').data('selected');
                                    if (selectedWard) {
                                        $('#ward_code').val(selectedWard);
                                    }
                                }
                            });
                        } else {
                            $('#ward_code').empty().append('<option value="">Chọn Xã</option>');
                        }
                    }

                    // Load districts and wards on page load if province is already selected
                    var initialProvince = '{{ old('province_code', $user->province_code) }}';
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
