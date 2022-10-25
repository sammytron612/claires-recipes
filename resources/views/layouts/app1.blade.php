<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @stack('styles')
    @livewireScripts
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    @livewireStyles
    <!-- Styles -->

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>


    </style>
</head>
<body class="d-flex flex-column" style="font-family: Merriweather,serif;min-height:100vh">

    <main class="mt-auto">
        @yield('content')
    </main>



    @include('includes.footer')
    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
