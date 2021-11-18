<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RPG') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://pagination.js.org/dist/2.1.5/pagination.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pagina.css') }}" rel="stylesheet">
    <style>
        .bg-black {
            background: url("/img/testwall.png") center top no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-color: black !important;
        }
        .bg-blue {
            background: linear-gradient(#2d0a9d 0%, #51ccff 50%, #0e3ea0 100%);
        }
        .card {
            background: rgba(0, 0, 0, 0.95) !important;
            color: #66aaaa !important;
            border: 2px solid #01194c;
            border-radius: 0;
            font-size: 16px;
        }
        .card-header {
            color: white;
            text-shadow: 2px 2px 8px #000;
            font-weight: bolder;
            text-align: center;
            font-size: 20px;
            border-radius: 0 !important;
            padding: 0.75rem 1.25rem !important;
        }
    </style>
</head>
<body class="bg-black">
    <div id="app">
        <main class="text-center">
            <img src="/img/impressum.png" style="max-width: 500px;pointer-events: none">
        </main>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
