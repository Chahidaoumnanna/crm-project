<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title', 'Login')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

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
