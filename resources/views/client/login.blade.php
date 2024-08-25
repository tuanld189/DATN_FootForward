@extends('client.layouts.master')
@section('title', 'Đăng nhập')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .login-container {
            background: #8a8f6a4a;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 40px auto;
        }

        .login-container .btn-primary,
        .login-container .btn-default {
            background: linear-gradient(to right, #000000);
            border: none;
            border-radius: 10px;
            color: white;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        .login-container .btn-primary:hover,
        .login-container .btn-default:hover {
            background: linear-gradient(to right, #444444);
            color: white;
        }

        .login-container .form-control {
            border-radius: 10px;
            border: 1px solid white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-check-label {
            color: black;
        }

        a {
            text-decoration: none;
        }


        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
            display: flex;
            align-items: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.5s ease, transform 0.5s ease;
            transform: translateY(-20px);
        }

        .alert-show {
            opacity: 1;
            transform: translateY(0);
        }

        .alert-success {
            background-color: #28a745;
            color: white;
        }

        .alert-danger {
            background-color: #dc3545;
            color: white;
        }

        .alert .icon {
            margin-right: 10px;
        }

        .alert .icon-success {
            content: "\2714";
            /* Checkmark icon */
            font-size: 20px;
        }

        .alert .icon-danger {
            content: "\26A0";
            /* Warning icon */
            font-size: 20px;
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
    <div class="text">
        <div class="login-container">
            <h2 class="text-center">Đăng nhập</h2>
            {{-- @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <strong><i class="fas fa-exclamation-circle"></i> {{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong><i class="fas fa-check-circle"></i> {{ $message }}</strong>
                </div>
            @endif --}}
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
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email"
                        placeholder="Vui lòng nhập email">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Vui lòng nhập mật khẩu">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ghi nhớ tôi</label>
                    </div>
                </div>
                <div class="form-group text-right">
                    <a href="#" data-toggle="modal" data-target="#forgotPasswordModal">Quên mật khẩu?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            </form>
            <div class="text-center">
                <a href="{{ route('signup') }}" class="btn btn-default">Đăng ký</a>
            </div>
        </div>
    </div>

    <!-- Modal for Forgot Password -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Quên mật khẩu?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border:none; ">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="forgotPasswordForm" action="{{ route('forgot.password') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="forgot_email">Nhập email bạn đã đăng kí để nhận lại mật khẩu:</label>
                            <input type="email" class="form-control" id="forgot_email" name="forgot_email"
                                placeholder="Vui lòng nhập email" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" style="border:none; border-radius: 10px;">Gửi
                            thông tin</button>
                    </form>
                </div>
            </div>
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
