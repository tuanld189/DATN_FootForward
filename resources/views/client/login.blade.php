@extends('client.layout.inheritance')

@section('content')

    <head>
        {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
        <style>
            body {
                padding-top: 500px;
                background: linear-gradient(to right, #ffffff, #ffffff);
                height: 100vh;
                justify-content: center;
                align-items: center;
                margin: 0;
                display: flex;
                flex-direction: column;
            }

            .login-container {
                background: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 400px;
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
        </style>
    </head>

    <body>
        <div class="text-center">
        <div class="login-container">
            <h2 class="text-center">Login</h2>
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>
            @endif
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username"><b style="color: black">Email</b></label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Type your email">
                </div>
                <div class="form-group">
                    <label for="password"><b style="color: black">Password</b></label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Type your password">
                </div>
                <div class="form-group text-right">
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            {{-- <div class="text-center social-btn">
            <a href="#" class="btn btn-outline-primary fab"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="#" class="btn btn-outline-info fab"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="#" class="btn btn-outline-danger fab"><i class="fab fa-google"></i> Google</a>
        </div> --}}
            <div class="text-center mt-4">
                <a href="{{ route('signup') }}" class="btn btn-link">Sign Up</a>
            </div>
        </div>
    </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </body>
@endsection
