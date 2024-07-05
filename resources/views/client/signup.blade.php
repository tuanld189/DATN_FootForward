@extends('client.layouts.master')
@section('title', 'Đăng ký')
@section('styles')
        <style>
            .signup-container {
                background: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 400px;
                flex: 1;
                margin: 0 auto;
            }

            .signup-container .btn-primary {
                background: linear-gradient(to right, #000000);
                border: none;
                border-radius: 10px;
            }

            .signup-container .social-btn {
                margin-top: 10px;
            }

            .signup-control {
                border-radius: 10px;
            }

            .fab {
                border-radius: 10px;
            }
        </style>
@endsection
    @section('content')
        <div class="signup-container">
            <h2 class="text-center">Sign Up</h2>

            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Vui lòng nhập name">
                </div>
                <div class="form-group">
                    <label for="username">Full Name</label>
                    <input type="text" class="form-control" id="username" name="fullname"
                        placeholder="Vui lòng nhập fullname">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Vui lòng nhập email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Vui lòng nhập password">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" placeholder="Xác nhận lại password">
                </div>
                <button type="submit" class="btn btn-primary btn-block" style="display: flex;

            margin: 10px auto;">Sign Up</button>
            </form>
            {{-- <div class="text-center social-btn">
            <a href="#" class="btn btn-outline-primary fab"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="#" class="btn btn-outline-info fab"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="#" class="btn btn-outline-danger fab"><i class="fab fa-google"></i> Google</a>
        </div> --}}
            <div class="text-center mt-4">
                <a href="{{ route('login') }}"  style=" border: none;
            border-radius: 10px;" class="btn btn-link">Login</a>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    @endsection
