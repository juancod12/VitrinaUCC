@extends('layouts.app')

@section('content')
<div class="bg-[#FDFDFC] min-h-screen pb-20">
    {{-- Banner o Mensajes de Éxito --}}
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-6 pt-6">
        <div class="bg-lime-50 border border-lime-200 text-lime-700 text-sm font-medium px-5 py-3 rounded-xl flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <div class="max-w-7xl mx-auto px-6 pt-10">
        <div class="flex flex-col lg:flex-row gap-10">
            
            {{-- Sidebar --}}
            <aside class="w-full lg:w-1/4">
                <div class="sticky top-6 space-y-8">
                    {{-- Buscador --}}
                    <form action="{{ route('public.products.index') }}" method="GET" class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="¿Qué buscas hoy?" 
                            class="w-full pl-10 pr-4 py-3 rounded-xl border-none shadow-sm focus:ring-2 focus:ring-[#0097d9] bg-white text-sm">
                        <button type="submit" class="absolute left-3 top-3.5 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </form>

                    {{-- Categorías --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-4 border-b pb-2">Explorar</h3>
                        <nav class="space-y-1">
                            <a href="{{ route('public.products.index') }}" 
                               class="flex items-center justify-between p-2 rounded-lg {{ !request('categoria') ? 'bg-blue-50 text-[#0097d9] font-bold' : 'text-gray-600 hover:bg-blue-50' }}">
                                <span>Todas</span>
                            </a>
                            @foreach($categorias as $cat)
                            <a href="{{ route('public.products.index', ['categoria' => $cat->slug]) }}" 
                               class="flex items-center justify-between group p-2 rounded-lg {{ request('categoria') == $cat->slug ? 'bg-blue-50 text-[#0097d9] font-bold' : 'text-gray-600 hover:bg-blue-50' }} transition">
                                <span class="group-hover:text-[#0097d9] font-medium">{{ $cat->nombre }}</span>
                                <span class="text-xs {{ request('categoria') == $cat->slug ? 'bg-[#0097d9] text-white' : 'bg-gray-100 text-gray-500' }} px-2 py-0.5 rounded-full">
                                    {{ $cat->productos_count }}
                                </span>
                            </a>
                            @endforeach
                        </nav>
                    </div>

                    {{-- Sección Mis Favoritos (Solo si está logueado) --}}
                    @auth
                    <a href="{{ route('user.buyer.favorites') }}" class="flex items-center gap-3 bg-red-50 hover:bg-red-100 border border-red-100 p-4 rounded-2xl transition group">
                        <svg class="w-5 h-5 text-red-500 group-hover:scale-110 transition" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                        <div>
                            <p class="text-sm font-black text-red-700">Mis Favoritos</p>
                            <p class="text-xs text-red-400">{{ auth()->user()->favoritos()->count() }} guardados</p>
                        </div>
                    </a>
                    @endauth
                </div>
            </aside>

            {{-- Main Grid --}}
            <main class="w-full lg:w-3/4">
                <div class="flex items-center justify-between mb-6">
                    <p class="text-gray-500 text-sm">Mostrando <span class="font-bold text-gray-800">{{ $productos->total() }}</span> productos locales</p>
                    
                    <form action="{{ route('public.products.index') }}" method="GET" id="sortForm">
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('categoria')) <input type="hidden" name="categoria" value="{{ request('categoria') }}"> @endif
                        <select name="sort" onchange="this.form.submit()" class="bg-transparent text-xs font-bold text-gray-500 uppercase tracking-widest border-none focus:ring-0 cursor-pointer">
                            <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Más recientes</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Menor precio</option>
                        </select>
                    </form>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                    @forelse($productos as $producto)
                    {{-- Comprobación de favoritos --}}
                    @php 
                        $esFavorito = auth()->check() && auth()->user()->favoritos->contains($producto->id); 
                    @endphp

                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 group border border-gray-100 flex flex-col h-full">
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="{{ asset('storage/' . $producto->imagen_principal) }}" alt="{{ $producto->nombre }}" 
                                class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            
                            <div class="absolute top-4 left-4">
                                <span class="bg-[#84cc16] text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-tighter shadow-lg">
                                    {{ $producto->stock > 0 ? 'Disponible' : 'Agotado' }}
                                </span>
                            </div>

                            {{-- Botón de Favorito (Sincronizado con la lógica de la primera vista) --}}
                            <div class="absolute top-4 right-4">
                                @auth
                                <form method="POST" action="{{ route('user.buyer.favorites.toggle', $producto->id) }}">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-full shadow-sm transition hover:scale-110 {{ $esFavorito ? 'bg-red-100' : 'bg-white/90 backdrop-blur-md' }}">
                                        <svg class="w-5 h-5 {{ $esFavorito ? 'text-red-500' : 'text-gray-400' }}" fill="{{ $esFavorito ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                                            <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                        </svg>
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('login') }}" class="p-2 bg-white/90 backdrop-blur-md rounded-full text-gray-300 hover:text-red-400 transition shadow-sm block">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                    </svg>
                                </a>
                                @endauth
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-[10px] font-bold text-[#0097d9] uppercase tracking-widest">{{ $producto->categoria->nombre }}</span>
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-[10px] text-gray-400 ml-1">4.9</span>
                                </div>
                            </div>

                            <h2 class="text-lg font-bold text-gray-800 mb-1 leading-tight group-hover:text-[#0097d9] transition">
                                {{ $producto->nombre }}
                            </h2>
                            <p class="text-xs text-gray-400 mb-4">Por: <span class="text-gray-600 font-semibold">{{ $producto->emprendedor->nombre_negocio }}</span></p>

                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-50">
                                <span class="text-2xl font-black text-gray-900">$ {{ number_format($producto->precio, 0, ',', '.') }}</span>
                                
                                {{-- Lógica de Carrito --}}
                                @auth
                                <form method="POST" action="{{ route('user.buyer.cart.add', $producto->id) }}">
                                    @csrf
                                    <button type="submit" class="bg-[#84cc16] hover:bg-[#74b614] hover:scale-110 transition-all text-white p-3 rounded-2xl shadow-lg shadow-[#84cc16]/30">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('login') }}" class="bg-[#84cc16] hover:bg-[#74b614] text-white p-3 rounded-2xl shadow-lg shadow-[#84cc16]/30 transition block">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-20">
                        <p class="text-gray-400 text-lg">No se encontraron productos con esos criterios.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-10">
                    {{ $productos->appends(request()->query())->links() }}
                </div>
            </main>
        </div>
    </div>
</div>
@endsection