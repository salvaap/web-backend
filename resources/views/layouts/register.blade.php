<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registro {{ config('app.name', 'Salva App') }}</title>

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

    <!-- fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Roboto:100,300,400,500,700,900" rel="stylesheet">

    <link rel="canonical" href="{{url('/')}}">
    <link rel="shortcut icon" href="/images/favicon.ico" />

    <!-- styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="antialiased min-h-screen">
    <div id="app" class="min-h-full w-full">
        <v-app class="w-full min-h-full">
            <div class="max-w-4xl w-full mx-auto pt-10">
                @yield('content')
            </div>
        </v-app>
    </div>
    <!-- scripts -->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>