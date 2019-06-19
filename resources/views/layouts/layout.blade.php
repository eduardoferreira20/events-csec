<!doctype html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

        @yield('style')
        <title>Calendário CSEC</title>
    </head>

    <body>
        @yield('content')
    </body>

    <script src="{{ asset('js/lib/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>  
    @yield('script')
</html>