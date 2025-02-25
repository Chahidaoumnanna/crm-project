<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title', 'Login')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .invalid-feedback {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="{{ asset('assets/img/login.png') }}" alt="Logo">
                    </div>
                    <div class="login-right">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
