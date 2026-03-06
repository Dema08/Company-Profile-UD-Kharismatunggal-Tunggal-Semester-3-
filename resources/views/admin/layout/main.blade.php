<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>General Dashboard &mdash; Stisla</title>
    <link rel="shortcut icon" href="{{ asset('user_assets/img/logo.png')  }}" type="image/x-icon">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @include('admin.layout.style')
    @stack('style')

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    @include('sweetalert::alert')
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('admin.layout.navbar')
            @include('admin.layout.sidebar')
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            @include('admin.layout.footer')
        </div>
    </div>

    @include('admin.layout.script')

    @stack('script')
</body>

</html>
