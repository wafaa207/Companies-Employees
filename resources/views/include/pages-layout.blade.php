
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
{{--    <link href="{{ asset('assets/css/iziToast.min.css') }}" rel="stylesheet"/>--}}
    <base href="/">
    <link href="./dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
{{--    <link href="{{ asset('back/dist/libs/ijaboCropTool/ijaboCropTool.min.css') }}" rel="stylesheet"/>--}}
    @stack('stylesheets')
    <link href="./dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>
<body >
{{--<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>--}}
<script src="./dist/js/demo-theme.min.js?1684106062"></script>
<div class="page">
    <!-- Navbar -->
    @include('layout.header')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="container-xl">
            @yield('pageHeader')
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                @yield('content')
            </div>
        </div>
        @include('layout.footer')
    </div>
</div>
<!-- Libs JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="./dist/libs/apexcharts/dist/apexcharts.min.js?1684106062" defer></script>
<script src="./dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062" defer></script>
{{--<script src="{{ asset('back/dist/libs/ijaboCropTool/ijaboCropTool.min.js') }}" defer></script>--}}
<script src="./dist/libs/jsvectormap/dist/maps/world.js?1684106062" defer></script>
<script src="./dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062" defer></script>
<!-- Tabler Core -->
<script src="./dist/js/tabler.min.js?1684106062" defer></script>
@stack('scripts')
<script src="./dist/js/demo.min.js?1684106062" defer></script>

</body>
</html>
