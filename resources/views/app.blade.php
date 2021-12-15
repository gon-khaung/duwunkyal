<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="This website is for people who want to buy clothes.">
        <meta name="keywords" content="Duwunkyal, Duwun Kyal, duwunkyal, duwun kyal, north pole">
        
        <title>Duwun Kyal</title>

         <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    
        <link rel="stylesheet" href="{{ asset('/build/css/app.css') }}">
        <script>
        window.baseUrl = "{{ url('/') }}";
        </script>
    </head>
    <body>
        <div id="app">
        </div>
        <script src="{{ asset('/build/js/app.js') }}"></script>
    </body>
    </html>