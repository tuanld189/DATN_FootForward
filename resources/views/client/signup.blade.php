@extends('client.layouts.master')
@section('title', 'Đăng ký')
@section('styles')
    <style>
        .signup-container {
            background: #8a8f6a4a;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            flex: 1;
            margin: 0 auto;
        }

        .signup-container .btn-primary,
        .signup-container .btn-link {
            background: linear-gradient(to right, #000000);
            border: none;
            border-radius: 10px;
            color: white;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        .signup-container .btn-link {
            background: transparent;

            text-align: center;
            padding: 10px;
            background-color: #8a8f6a;
            height: 40px;
        }

        .signup-container .btn-primary:hover,
        .signup-container .btn-link:hover {
            background: linear-gradient(to right, #444444);
            color: white;
        }

        .signup-container .form-control {
            border-radius: 10px;
            border: 1px solid white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .fab {
            border-radius: 10px;
        }

        .social-btn {
            margin-top: 10px;
        }
    </style>
    <style>
        .close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            float: right;
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-show" id="alert">
            <span class="icon icon-success"></span>
            {{ session('success') }}
            <button type="button" class="close" onclick="closeAlert()">&times;</button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-show" id="alert">
            <span class="icon icon-danger"></span>
            {{ session('error') }}
            <button type="button" class="close" onclick="closeAlert()">&times;</button>
        </div>
    @endif


    <div class="signup-container">
        <h2 class="text-center">Đăng Ký</h2>

        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Vui lòng nhập tên">
            </div>
            <div class="form-group">
                <label for="username">Họ và tên</label>
                <input type="text" class="form-control" id="username" name="fullname"
                    placeholder="Vui lòng nhập họ và tên">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Vui lòng nhập email">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Vui lòng nhập mật khẩu">
            </div>
            <div class="form-group">
                <label for="confirm-password">Xác nhận mật khẩu</label>
                <input type="password" class="form-control" id="confirm-password" name="password_confirmation"
                    placeholder="Xác nhận lại mật khẩu">
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-3">Đăng Ký</button>
        </form>

        <div class="text-center">
            <a href="{{ route('login') }}" class="btn btn-link">Đăng Nhập</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.onload = function() {
            var alert = document.getElementById('alert');
            if (alert) {
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 3000);
            }
        };

        // Hàm ẩn thông báo ngay lập tức khi nhấn nút "Close"
        function closeAlert() {
            var alert = document.getElementById('alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endsection
