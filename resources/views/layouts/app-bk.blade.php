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
    <div id="app">
        <div id="main-container">
            <div id="header-container" :class="(menuFixed) ? 'scrolled' : ''">
                <div id="header-brand">
                    <h1 id="logo"><a href="/">Salva<span class="accent">App</span></a></h1>
                    <Dropdown class="inline-block min-w-dropdown" :items="{{json_encode($categories_arr)}}" :unselected_label="`Categorías`" :has_label="false" :label_text="null"></Dropdown>
                </div>
                <div id="header-search" class="w-100 px-4">
                    <div id="header-search-box" class="flex bg-gray-200 px-4 items-center rounded border">
                        <span class="text-gray-900 flex-grow-0 mr-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        </span>
                        <input type="search" class="flex-grow bg-transparent px-2 py-1 text-gray-700" placeholder="Busca tu producto acá...">
                    </div>
                </div>
                <div id="header-menu">
                    <a href="#" class="inline-block font-semibold mr-8 text-primary-500 hover:text-primary-900">
                        <span class="icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                        </span>
                        <span>Ofertas</span>
                    </a>
                    <a href="#" class="inline-block font-semibold mr-8 text-primary-500 hover:text-primary-900">
                        <span class="icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        </span>
                        <span>Vender</span>
                    </a>
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                    @else
                    <a href="#" class="inline-block font-semibold mr-8 text-primary-500 hover:text-primary-900"><span>Hola,&nbsp;</span>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</a>
                    @endguest
                </div>
            </div>
            @yield('content')
            <div style="z-index: 100;" class="flex justify-between relative w-full px-4 py-4 bg-primary-800">
                <p class="text-center text-sm text-white mb-0">Derechos Reservados SalvaApp. 2020</p>
                <p class="text-center text-sm mb-0 text-white"><a class="inline-block mr-2 text-gray-400 hover:text-white" href="#">Politicas de Privacidad</a><span class="inline-block mr-2">|</span><a class="inline-block mr-2 text-gray-400 hover:text-white" href="#">Terminos y Condiciones</a><span class="inline-block mr-2">|</span><a class="inline-block text-gray-400 hover:text-white" href="#">Devoluciones</a></p>
            </div>
        </div>
    </div>
    <!-- scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>