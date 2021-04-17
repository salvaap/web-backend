<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Salva App') }}</title>

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <meta name="og:title" content="">
    <meta name="og:description" content="">
    <meta name="og:image" content="">
    <meta name="og:url" content="">

    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">

    <!-- scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Roboto:100,300,400,500,700,900" rel="stylesheet">

    <link rel="canonical" href="{{url('/')}}">
    <link rel="shortcut icon" href="/images/favicon.ico" />

    <!-- styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <noscript>
        <strong>Lo sentimos, Salva App no funciona correctamente con JavaScript deshabilitado. Habilita JavaScript para continuar.</strong>
    </noscript>
    <div id="app">
      <App :c="{{json_encode($categories)}}" :u="{{ json_encode(auth()->user()) }}"></App>
    </div>
    <!-- scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>