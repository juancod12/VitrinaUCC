<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Mi Cuenta — {{ config('app.name', 'Vitrina UCC') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" rel="stylesheet" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @stack('styles')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            [x-cloak] { display: none !important; }
            .user-sidebar-link {
                display: flex; align-items: center; gap: 12px; padding: 10px 16px;
                border-radius: 12px; font-size: 14px; font-weight: 500;
                color: #4b5563; transition: all 0.2s;
                border: 1.5px solid transparent;
            }
            .user-sidebar-link:hover { background: #f0f9ff; color: #0284c7; border-color: #bae6fd; }
            .user-sidebar-link.active { background: linear-gradient(135deg, #0ea5e9, #0284c7); color: white; box-shadow: 0 4px 14px rgba(2,132,199,0.3); }
            .user-sidebar-link .icon { width: 36px; height: 36px; border-radius: 8px; display:flex; align-items:center; justify-content:center; flex-shrink: 0; background: rgba(255,255,255,0.2); }
            .user-sidebar-link:not(.active) .icon { background: #e0f2fe; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-gray-900">
        <div class="min-h-screen">
            @include('layouts.navigation')

            {{-- Banner superior del panel --}}
            <div class="bg-gradient-to-r from-sky-600 via-sky-500 to-cyan-500 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 left-1/4 w-64 h-64 bg-lime-400 rounded-full -translate-y-1/2"></div>
                    <div class="absolute bottom-0 right-1/4 w-48 h-48 bg-white rounded-full translate-y-1/2"></div>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm border border-white/30 flex items-center justify-center text-2xl font-black text-white shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sky-100 text-xs font-bold uppercase tracking-widest">Mi cuenta</p>
                            <h1 class="text-white text-xl font-black">{{ Auth::user()->name }}</h1>
                            <p class="text-sky-200 text-sm">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 py-8">
                <div class="flex flex-col lg:flex-row gap-8">

                    {{-- Sidebar --}}
                    <aside class="w-full lg:w-64 flex-shrink-0">
                        <div class="sticky top-6 bg-white rounded-2xl shadow-sm border border-gray-100 p-4 space-y-1">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-4 pb-2 pt-1">Mi Espacio</p>

                            <a href="{{ route('user.buyer.dashboard') }}"
                               class="user-sidebar-link {{ request()->routeIs('user.buyer.dashboard') ? 'active' : '' }}">
                                <span class="icon">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                </span>
                                Inicio
                            </a>

                            <a href="{{ route('user.buyer.cart') }}"
                               class="user-sidebar-link {{ request()->routeIs('user.buyer.cart') ? 'active' : '' }}">
                                <span class="icon">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </span>
                                Mi Carrito
                                @php $cartCount = session('cart') ? array_sum(array_column(session('cart'), 'cantidad')) : 0; @endphp
                                @if($cartCount > 0)
                                    <span class="ml-auto bg-lime-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">{{ $cartCount }}</span>
                                @endif
                            </a>

                            <a href="{{ route('user.buyer.orders') }}"
                               class="user-sidebar-link {{ request()->routeIs('user.buyer.orders*') ? 'active' : '' }}">
                                <span class="icon">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                </span>
                                Mis Pedidos
                            </a>

                            <a href="{{ route('user.buyer.profile') }}"
                               class="user-sidebar-link {{ request()->routeIs('user.buyer.profile') ? 'active' : '' }}">
                                <span class="icon">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </span>
                                Mi Perfil
                            </a>

                            <a href="{{ route('user.buyer.favorites') }}"
                               class="user-sidebar-link {{ request()->routeIs('user.buyer.favorites') ? 'active' : '' }}">
                                <span class="icon">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                                </span>
                                Mis Favoritos
                                @php $favCount = auth()->user()->favoritos()->count(); @endphp
                                @if($favCount > 0)
                                    <span class="ml-auto bg-red-400 text-white text-[10px] font-black px-2 py-0.5 rounded-full">{{ $favCount }}</span>
                                @endif
                            </a>

                            <a href="{{ route('user.buyer.addresses') }}"
                               class="user-sidebar-link {{ request()->routeIs('user.buyer.addresses') ? 'active' : '' }}">
                                <span class="icon">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </span>
                                Mis Direcciones
                            </a>

                            <div class="border-t border-gray-100 my-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="user-sidebar-link w-full text-left hover:!bg-red-50 hover:!text-red-600 hover:!border-red-200">
                                        <span class="icon !bg-red-50">
                                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        </span>
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </aside>

                    {{-- Contenido principal --}}
                    <main class="flex-1 min-w-0">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>