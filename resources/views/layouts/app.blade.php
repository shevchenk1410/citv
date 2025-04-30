<!DOCTYPE html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-position="fixed" data-preloader="disable">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico">
    <title>@yield('title') | {{ config('app.name') }}</title>
    @include('partials.styles')
    @yield('custom-css')
</head>
<body>
    <div id="layout-wrapper">
        @include('partials.topbar')
        @include('partials.nav')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
    @include('partials.scripts')
    @yield('custom-js')
</body>
</html>