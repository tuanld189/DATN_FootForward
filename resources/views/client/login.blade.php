@extends('client.layouts.master')
@section('title', 'Đăng nhập')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            justify-content: center;
            margin: 40px auto;
        }

        .login-container .btn-primary {
            background: linear-gradient(to right, #000000);
            border: none;
            border-radius: 10px;
        }

        .login-container .social-btn {
            margin-top: 10px;
        }

        .form-control {
            border-radius: 10px;
        }

        .fab {
            border-radius: 10px;
        }

        a {
            text-decoration: none;
        }
    </style>
@endsection
@section('content')
    <div class="text">
        <div class="login-container">
            <h2 class="text-center">Đăng nhập</h2>
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <strong><i class="fas fa-exclamation-circle"></i> {{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong><i class="fas fa-check-circle"></i> {{ $message }}</strong>
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email"><b style="color: black">Email</b></label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Vui lòng nhập email">
                </div>
                <div class="form-group">
                    <label for="password"><b style="color: black">Mật khẩu</b></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Vui lòng nhập mật khẩu">
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
                <button type="submit" class="btn btn-primary btn-block" style="display: flex; margin: 10px auto;">Đăng nhập</button>
            </form>
            <div class="text-left mt-4">
                <a href="{{ route('signup') }}" style="border: none; border-radius: 10px; margin: 0 auto;" class="btn btn-default">Đăng ký</a>
            </div>
        </div>
    </div>

    <!-- Modal for Forgot Password -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Quên mật khẩu?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="border:none; ">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="forgotPasswordForm" action="{{ route('forgot.password') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="forgot_email">Nhập email bạn đã đăng kí để nhận lại mật khẩu:</label>
                            <input type="email" class="form-control" id="forgot_email" name="forgot_email" placeholder="Vui lòng nhập email" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" style="border:none; border-radius: 10px;">Gửi thông tin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endsection
