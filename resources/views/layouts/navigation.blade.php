<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BARRA DE NAVEGACION') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/90 backdrop-blur-md shadow-sm border-b border-gray-100 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16"> 
                    
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center mr-8">
                            <span class="text-2xl font-bold tracking-tight">
                                <span class="text-sky-500">Vitrina</span><span class="text-lime-500"> UCC</span>
                            </span>
                        </div>
                        
                        <div class="hidden md:flex md:space-x-8 items-center h-full">
                            @php
                                $links = [
                                    ['route' => 'dashboard', 'label' => 'Hoy', 'active' => request()->routeIs('dashboard')],
                                    ['route' => '/', 'label' => 'Inicio', 'active' => request()->is('/')],
                                    ['route' => 'public.products.index', 'label' => 'Productos', 'active' => request()->routeIs('public.products.index')],
                                    ['route' => '#', 'label' => 'Servicios', 'active' => request()->routeIs('servicios.*')],
                                    ['route' => '#', 'label' => 'Proyectos', 'active' => request()->routeIs('proyectos.*')],
                                ];
                            @endphp

                            @foreach($links as $link)
                                <a href="{{ $link['route'] !== '#' ? (Route::has($link['route']) ? route($link['route']) : $link['route']) : '#' }}"
                                class="{{ $link['active'] 
                                            ? 'border-lime-500 text-gray-900' 
                                            : 'border-transparent text-gray-500 hover:text-sky-600 hover:border-sky-300' }} 
                                        inline-flex items-center px-1 pb-1 border-b-2 text-sm font-bold transition duration-150 ease-in-out">
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="hidden md:flex items-center space-x-4">
                        <button class="text-sky-600 px-3 py-2 text-sm font-semibold hover:bg-sky-50 rounded-lg transition">
                            Aliados
                        </button>

                        {{-- 🛒 Carrito de compras rápido --}}
                        @auth
                            @php $cartCount = collect(session('cart'))->sum('cantidad'); @endphp
                            <a href="{{ route('user.buyer.cart') }}"
                               title="Ir al carrito"
                               class="relative flex flex-col items-center text-gray-500 hover:text-lime-600 transition group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <span class="text-[9px] font-black uppercase">Carrito</span>
                                @if($cartCount > 0)
                                    <span class="absolute -top-1.5 -right-1.5 bg-lime-500 text-white text-[10px] font-black w-4 h-4 rounded-full flex items-center justify-center shadow">
                                        {{ $cartCount > 9 ? '9+' : $cartCount }}
                                    </span>
                                @endif
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               title="Inicia sesión para ver tu carrito"
                               class="flex flex-col items-center text-gray-400 hover:text-lime-500 transition group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <span class="text-[9px] font-black uppercase">Carrito</span>
                            </a>
                        @endauth

                        <button class="bg-lime-500 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-lime-600 shadow-md shadow-lime-100 transition">
                            Acceso Comunidad
                        </button>

                        @guest
                            <a href="{{ route('login') }}" class="flex flex-col items-center text-gray-500 hover:text-sky-600 transition group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="text-[9px] font-black uppercase">Ingresar</span>
                            </a>
                        @endguest

                        @auth
                            <div class="relative" x-data="{ openAccount: false }">
                                <button @click="openAccount = !openAccount" @click.away="openAccount = false" class="flex flex-col items-center text-gray-700 hover:text-sky-600 focus:outline-none transition group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-[9px] font-black uppercase">Mi Cuenta</span>
                                </button>

                                <div x-show="openAccount" x-cloak x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden">
                                    <div class="px-4 py-3 bg-gray-50/50 border-b border-gray-100">
                                        <p class="text-xs text-gray-500 font-bold uppercase text-center">Hola,</p>
                                        <p class="text-sm text-center font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class="py-1">
                                        @if(Auth::user()->esEmprendedor())
                                            <a href="{{ route('user.seller.sellerPanel') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 transition">Mi Panel</a>
                                        @else
                                            <a href="{{ route('user.buyer.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-sky-50 transition">Mi Cuenta</a>
                                            <a href="{{ route('user.buyer.cart') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-lime-50 transition">
                                                <svg class="w-4 h-4 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                                Mi Carrito
                                                @php $cartCount = collect(session('cart'))->sum('cantidad'); @endphp
                                                @if($cartCount > 0)
                                                    <span class="ml-auto bg-lime-500 text-white text-[10px] font-black px-1.5 py-0.5 rounded-full">{{ $cartCount }}</span>
                                                @endif
                                            </a>
                                        @endif
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">Cerrar Sesión</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>

                    {{-- Botón hamburguesa móvil --}}
                    <div class="flex items-center md:hidden">
                        {{-- Carrito móvil visible siempre en la barra --}}
                        @auth
                            @php $cartCountMobile = collect(session('cart'))->sum('cantidad'); @endphp
                            <a href="{{ route('user.buyer.cart') }}" class="relative mr-3 text-gray-500 hover:text-lime-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                @if($cartCountMobile > 0)
                                    <span class="absolute -top-1.5 -right-1.5 bg-lime-500 text-white text-[10px] font-black w-4 h-4 rounded-full flex items-center justify-center">
                                        {{ $cartCountMobile > 9 ? '9+' : $cartCountMobile }}
                                    </span>
                                @endif
                            </a>
                        @endauth

                        <button @click="open = !open" class="p-2 rounded-md text-gray-400 hover:text-sky-500 hover:bg-gray-100 transition focus:outline-none">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Menú móvil desplegable --}}
            <div x-show="open" 
                x-cloak 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                @click.away="open = false" 
                class="md:hidden bg-white border-t border-gray-100 shadow-inner">
                
                <div class="pt-2 pb-3 space-y-1">
                    <a href="/" class="{{ request()->is('/') ? 'bg-lime-50 border-lime-500 text-lime-700' : 'border-transparent text-gray-600' }} block pl-3 pr-4 py-3 border-l-4 text-base font-bold">Inicio</a>
                    <a href="{{ route('public.products.index') }}" class="{{ request()->routeIs('public.products.index') ? 'bg-lime-50 border-lime-500 text-lime-700' : 'border-transparent text-gray-600' }} block pl-3 pr-4 py-3 border-l-4 text-base font-bold">Productos</a>
                    <a href="#" class="border-transparent text-gray-600 block pl-3 pr-4 py-3 border-l-4 text-base font-bold">Servicios</a>
                    <a href="#" class="border-transparent text-gray-600 block pl-3 pr-4 py-3 border-l-4 text-base font-bold">Proyectos</a>
                </div>

                <div class="pt-4 pb-3 border-t border-gray-100 px-4 space-y-3">
                    @guest
                        <a href="{{ route('login') }}" class="w-full flex items-center justify-center bg-sky-500 text-white py-2 rounded-lg font-bold">Ingresar</a>
                    @else
                        <div class="flex items-center px-4 mb-2">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 font-bold uppercase">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-bold text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        @if(Auth::user()->esEmprendedor())
                            <a href="{{ route('user.seller.sellerPanel') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-50 rounded-md">Mi Panel</a>
                        @else
                            <a href="{{ route('user.buyer.dashboard') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-50 rounded-md">Mi Cuenta</a>
                            <a href="{{ route('user.buyer.cart') }}" class="flex items-center gap-2 px-3 py-2 text-base font-medium text-lime-600 hover:bg-lime-50 rounded-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                Mi Carrito
                                @php $cartCountMenu = collect(session('cart'))->sum('cantidad'); @endphp
                                @if($cartCountMenu > 0)
                                    <span class="bg-lime-500 text-white text-xs font-black px-2 py-0.5 rounded-full">{{ $cartCountMenu }}</span>
                                @endif
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium text-red-600 hover:bg-red-50 rounded-md">Cerrar Sesión</button>
                        </form>
                    @endguest
                    
                    <button class="w-full bg-gray-100 text-gray-700 py-2 rounded-lg font-bold">Aliados y Ciudadanía</button>
                </div>
            </div>
        </nav>
    </body>
</html>