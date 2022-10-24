<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sharity - @yield('title')</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome-all.min.css') }}">
    @yield('styles')

</head>

<body id="page-top">
    <div id="wrapper" style="height: 100vh;">
        @include('components.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.topbar')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('components.footer')
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/js/theme.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
