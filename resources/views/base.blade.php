<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
    @yield('react')
</head>
<body class="layout-fixed sidebar-expand-lg">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        @include('partials.header')
        @include('partials.sidebar')
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6"><h3 class="mb-0">@yield('bodyTitle', 'Admin')</h3></div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    @yield('body')
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        @include('partials.footer')
    </div>
{{--    <div id="react-root"></div>--}}
{{--    <script src="{{ asset('js/theme.js') }}"></script>--}}
</body>
</html>
