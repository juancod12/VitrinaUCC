@extends('layouts.userPanel')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-black text-gray-900">Mis Favoritos</h2>
            <p class="text-sm text-gray-500 mt-0.5">Productos que guardaste para después</p>
        </div>
        <a href="{{ route('public.products.index') }}"
           class="text-xs font-bold text-sky-600 hover:underline flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Explorar más
        </a>
    </div>

    @if(session('success'))
    <div class="bg-lime-50 border border-lime-200 text-lime-700 text-sm font-medium px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    @if($favoritos->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
        @foreach($favoritos as $producto)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-red-100 transition-all duration-300 group overflow-hidden flex flex-col">

            {{-- Imagen --}}
            <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">
                @if($producto->imagen_principal)
                    <img src="{{ asset('storage/' . $producto->imagen_principal) }}"
                         alt="{{ $producto->nombre }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-5xl bg-gradient-to-br from-gray-50 to-gray-100">📦</div>
                @endif

                {{-- Botón quitar favorito --}}
                <form method="POST" action="{{ route('user.buyer.favorites.toggle', $producto->id) }}" class="absolute top-3 right-3">
                    @csrf
                    <button type="submit"
                            title="Quitar de favoritos"
                            class="p-2 bg-white rounded-full shadow-md hover:bg-red-50 transition group/btn">
                        <svg class="w-5 h-5 text-red-500 group-hover/btn:scale-110 transition" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                        </svg>
                    </button>
                </form>
            </div>

            {{-- Info --}}
            <div class="p-5 flex flex-col flex-grow">
                <p class="text-[10px] font-bold text-sky-600 uppercase tracking-widest mb-1">
                    {{ optional($producto->categoria)->nombre ?? 'Sin categoría' }}
                </p>
                <h3 class="text-base font-black text-gray-900 leading-tight mb-1 group-hover:text-sky-700 transition">
                    {{ $producto->nombre }}
                </h3>
                <p class="text-xs text-gray-400 mb-4">
                    Por: <span class="text-gray-600 font-semibold">{{ optional($producto->emprendedor)->nombre_negocio ?? 'Vitrina UCC' }}</span>
                </p>

                <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between gap-3">
                    <span class="text-xl font-black text-gray-900">
                        ${{ number_format($producto->precio, 0, ',', '.') }}
                    </span>
                    <form method="POST" action="{{ route('user.buyer.cart.add', $producto->id) }}">
                        @csrf
                        <button type="submit"
                                class="flex items-center gap-2 bg-lime-500 hover:bg-lime-600 text-white text-xs font-black px-4 py-2.5 rounded-xl transition shadow-sm shadow-lime-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Al carrito
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Paginación --}}
    @if($favoritos->hasPages())
    <div class="flex justify-center">
        {{ $favoritos->links() }}
    </div>
    @endif

    @else
    {{-- Estado vacío --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-14 text-center">
        <div class="w-20 h-20 bg-red-50 rounded-3xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-red-200" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
            </svg>
        </div>
        <h3 class="text-base font-black text-gray-700 mb-1">Aún no tienes favoritos</h3>
        <p class="text-sm text-gray-400 mb-6">Toca el ❤️ en cualquier producto para guardarlo aquí.</p>
        <a href="{{ route('public.products.index') }}"
           class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-bold px-6 py-3 rounded-xl text-sm shadow-md shadow-sky-100 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            Explorar productos
        </a>
    </div>
    @endif

</div>
@endsection
