<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        Starter APP
    </title>
    <!-- CSS files -->
    <link href="/assets/css/tabler.min.css?1684106062" rel="stylesheet" />
    <link href="/assets/css/tabler-flags.min.css?1684106062" rel="stylesheet" />
    <link href="/assets/css/tabler-payments.min.css?1684106062" rel="stylesheet" />
    <link href="/assets/css/tabler-vendors.min.css?1684106062" rel="stylesheet" />
    <link href="/assets/css/demo.min.css?1684106062" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


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

<body>
    @include('sweetalert::alert')
    <script src="/assets/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
        <!-- Navbar -->
        @include('public.layouts.header')

        <div class="page-wrapper">
            <!-- Page header -->
            @yield('content')
            @include('public.layouts.footer')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="/assets/js/tabler.min.js?1684106062" defer></script>
    <script src="/assets/js/demo.min.js?1684106062" defer></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    @stack('js')
</body>

</html>
