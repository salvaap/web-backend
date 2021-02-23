<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administración {{ config('app.name', 'Salva App') }}</title>

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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="canonical" href="{{url('/')}}">
    <link rel="shortcut icon" href="/images/favicon.ico" />

    <!-- styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="antialiased min-h-screen">
    <div id="app" class="min-h-full w-full">
        <v-app class="w-full min-h-full">
            <aside aria-label="aside bar" aria-orientation="vertical" class="w-64 flex-none flex flex-col items-center text-center bg-primary-500 text-gray-200">
                <div class="h-16 flex items-center w-full bg-primary-700 flex-grow-0">
                    <!--<img class="h-6 w-6 mx-auto" src="https://raw.githubusercontent.com/bluebrown/tailwind-zendesk-clone/master/public/assets/leaves.png" />-->
                    <span class="block text-center w-full text-lg m-0 p-0 text-white">Salva<span class="text-accent-500">App</span></span>
                </div>
                <ul class="main-navigation">
                    <!--<li class="main-navigation--item active">
                        <a href="{{ route('dashboard.index') }}" class="main-navigation--link">
                            <v-icon small class="mr-2">mdi-home</v-icon>
                            <span>Escritorio</span>
                        </a>
                    </li>
                    <li class="main-navigation--item">
                        <a href="#" class="main-navigation--link">
                            <v-icon small class="mr-2">mdi-format-list-bulleted</v-icon>
                            <span>Pedidos</span>
                        </a>
                    </li>
                    <li class="main-navigation--item">
                        <a href="#" class="main-navigation--link">
                            <v-icon small class="mr-2">mdi-account-group</v-icon>
                            <span>Clientes</span>
                        </a>
                    </li>
                    <li class="main-navigation--item">
                        <a href="#" class="main-navigation--link">
                            <v-icon small class="mr-2">mdi-gift</v-icon>
                            <span>Cupones</span>
                        </a>
                    </li>
                    <li class="main-navigation--item">
                        <a href="#" class="main-navigation--link">
                            <v-icon small class="mr-2">mdi-package</v-icon>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li class="main-navigation--item">
                        <a href="#" class="main-navigation--link">
                            <v-icon small class="mr-2">mdi-chart-bar</v-icon>
                            <span>Reportes</span>
                        </a>
                    </li>
                    <li class="main-navigation--item">
                        <a href="#" class="main-navigation--link">
                            <v-icon small class="mr-2">mdi-cog</v-icon>
                            <span>Configuraciones</span>
                        </a>
                    </li>-->
                    @foreach($sidebar as $s)
                    <li class="main-navigation--item">
                        <a href="{{route($s->action.'.index')}}" class="main-navigation--link">
                            <v-icon small class="mr-2">{{$s->icon}}</v-icon>
                            <span>{{$s->title}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <!--<div class="mt-auto h-16 flex items-center w-full flex-grow-0">
                    <img style="filter: invert(85%);" class="h-8 w-10 mx-auto" src="https://raw.githubusercontent.com/bluebrown/tailwind-zendesk-clone/master/public/assets/chi.png" />
                </div>-->
            </aside>
            <div class="flex-1 flex flex-col">
                <nav class="relative z-50 border-b bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between h-16">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                </div>
                                <div class="hidden md:block">
                                    <div class="ml-10 flex items-baseline space-x-4">
                                    </div>
                                </div>
                            </div>
                            <div class="hidden md:block">
                                <div class="ml-4 flex items-center md:ml-6">
                                    <!--<button class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700" aria-label="Notifications">
                                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                    </button>-->

                                    <!-- Profile dropdown -->
                                    @guest
                                    <v-btn href="{{ route('login') }}" text tile small>Iniciar Sesión</v-btn>
                                    @else
                                    <v-menu offset-y>
                                        <template v-slot:activator="{ on }">
                                            <v-btn text tile v-on="on" small><v-avatar class="mr-2" tile size="24"><img src="/images/avatar.jpg" alt="{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}"></v-avatar><span>Hola,&nbsp;</span>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}&nbsp;<v-icon>mdi-dots-vertical</v-icon></v-btn>
                                        </template>
                                        <v-list dense>
                                            @foreach($toolbar as $t)
                                            <v-list-item href="{{route($t->action.'.index')}}">
                                                <v-list-item-icon><v-icon>{{$t->icon}}</v-icon></v-list-item-icon>
                                                <v-list-item-title>{{$t->title}}</v-list-item-title>
                                            </v-list-item>
                                            @endforeach
                                            <v-list-item href="#">
                                                <v-list-item-icon><v-icon>mdi-lifebuoy</v-icon></v-list-item-icon>
                                                <v-list-item-title>Ayuda</v-list-item-title>
                                            </v-list-item>
                                            <v-list-item href="#">
                                                <v-list-item-icon><v-icon>mdi-help</v-icon></v-list-item-icon>
                                                <v-list-item-title>FAQs</v-list-item-title>
                                            </v-list-item>
                                            <v-list-item @click="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <v-list-item-icon><v-icon>mdi-exit-to-app</v-icon></v-list-item-icon>
                                                <v-list-item-title>Cerrar Sesión</v-list-item-title>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </v-list-item>
                                        </v-list>
                                    </v-menu>
                                    @endguest
                                    <!--<div class="ml-3 relative">
                                        <div>
                                            <v-avatar size="36">
                                                <img src="/images/avatar.jpg" alt="John Doe">
                                            </v-avatar>
                                        </div>-->
                                        <!--
                                            Profile dropdown panel, show/hide based on dropdown state.

                                            Entering: "transition ease-out duration-100"
                                            From: "transform opacity-0 scale-95"
                                            To: "transform opacity-100 scale-100"
                                            Leaving: "transition ease-in duration-75"
                                            From: "transform opacity-100 scale-100"
                                            To: "transform opacity-0 scale-95"
                                        -->
                                        <!--<div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                                            <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</a>

                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>

                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                            <div class="-mr-2 flex md:hidden">
                            <!-- Mobile menu button -->
                                <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
                                    <!-- Menu open: "hidden", Menu closed: "block" -->
                                    <svg class="block h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                    <!-- Menu open: "block", Menu closed: "hidden" -->
                                    <svg class="hidden h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </nav>
                @yield('content')
            </div>
        </v-app>
    </div>
    <!-- scripts -->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>