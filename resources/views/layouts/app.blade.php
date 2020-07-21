<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="bg-gray-800">
        <div class="container py-12">
            @yield('content')
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
        @stack('scripts') 
    </body>
</html>
