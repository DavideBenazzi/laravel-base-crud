<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel-base-crud</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js">
    </head>
    <body>
       {{-- HEADER --}}
       @include('partials.header');
       {{-- MAIN --}}
       @yield('content');
       {{-- FOOTER --}}
       @include('partials.footer'); 
    </body>
</html>