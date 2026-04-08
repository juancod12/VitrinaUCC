<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Panel de Vendedor') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600&display=swap" rel="stylesheet" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @stack('styles')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h1 class="text-xl font-bold tracking-tight text-gray-800 dark:text-gray-200">
                            {{ $header }}
                        </h1>
                    </div>
                </header>
            @endisset

            <div class="max-w-7xl mx-auto px-4 py-8">
                <div class="flex flex-col lg:flex-row gap-8">
                    
                    <aside class="w-full lg:w-64 flex-shrink-0">
                        <div class="sticky top-6">
                            <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4 px-4">
                                Menú de Gestión
                            </h2>
                            <nav class="space-y-1">
                                
                                {{-- Mis Productos --}}
                                <a href="{{ route('user.seller.products') }}"
                                class="flex items-center px-4 py-3 text-sm font-medium border-l-4 transition-all duration-200 
                                {{ request()->routeIs('user.seller.products') 
                                    ? 'border-blue-600 bg-blue-50 text-blue-700 dark:bg-gray-800 dark:text-blue-400' 
                                    : 'border-transparent text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800' }}">
                                    <span class="mr-3 text-lg">📦</span> Mis Productos
                                </a>

                                {{-- Mis Publicaciones (Cambia 'nombre.de.ruta' por la real) --}}
                                <a href="#"
                                class="flex items-center px-4 py-3 text-sm font-medium border-l-4 transition-all duration-200 
                                {{ request()->routeIs('seller.publications.*') 
                                    ? 'border-blue-600 bg-blue-50 text-blue-700 dark:bg-gray-800 dark:text-blue-400' 
                                    : 'border-transparent text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800' }}">
                                    <span class="mr-3 text-lg">📣</span> Mis Publicaciones
                                </a>

                                {{-- Mi Negocio --}}
                                <a href="#"
                                class="flex items-center px-4 py-3 text-sm font-medium border-l-4 transition-all duration-200 
                                {{ request()->routeIs('seller.business.*') 
                                    ? 'border-blue-600 bg-blue-50 text-blue-700 dark:bg-gray-800 dark:text-blue-400' 
                                    : 'border-transparent text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800' }}">
                                    <span class="mr-3 text-lg">🏢</span> Mi Negocio
                                </a>

                                {{-- Comentarios --}}
                                <a href="#"
                                class="flex items-center px-4 py-3 text-sm font-medium border-l-4 transition-all duration-200 
                                {{ request()->routeIs('seller.comments.*') 
                                    ? 'border-blue-600 bg-blue-50 text-blue-700 dark:bg-gray-800 dark:text-blue-400' 
                                    : 'border-transparent text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800' }}">
                                    <span class="mr-3 text-lg">💬</span> Comentarios
                                </a>

                            </nav>
                        </div>
                    </aside>

                    <main class="flex-1">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 min-h-[500px] p-8">
                            
                            {{-- Aquí es donde cargarás tus otras vistas --}}
                            @yield('content')
                            
                        </div>
                    </main>

                </div>
            </div>
        </div>
    </body>
</html>