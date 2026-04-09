@extends('layouts.userPanel')

@section('content')
<div class="space-y-6">

    {{-- Tarjetas de resumen --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div>
                <p class="text-2xl font-black text-gray-900">{{ $totalPedidos ?? 0 }}</p>
                <p class="text-xs text-gray-500 font-medium">Pedidos realizados</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-lime-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-black text-gray-900">{{ $cartItems ?? 0 }}</p>
                <p class="text-xs text-gray-500 font-medium">Productos en carrito</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-black text-gray-900">{{ $totalFavoritos ?? 0 }}</p>
                <p class="text-xs text-gray-500 font-medium">Favoritos</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-4">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-black text-gray-900">{{ $totalDirecciones ?? 0 }}</p>
                <p class="text-xs text-gray-500 font-medium">Direcciones guardadas</p>
            </div>
        </div>
    </div>

    {{-- Accesos rápidos --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h2 class="text-base font-black text-gray-800 mb-4">¿Qué quieres hacer hoy?</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
            <a href="{{ route('public.products.index') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-sky-50 hover:bg-sky-100 transition group border border-sky-100">
                <div class="w-10 h-10 rounded-xl bg-sky-500 flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <span class="text-xs font-bold text-sky-700 text-center">Ver Productos</span>
            </a>
            <a href="{{ route('user.buyer.cart') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-lime-50 hover:bg-lime-100 transition group border border-lime-100">
                <div class="w-10 h-10 rounded-xl bg-lime-500 flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4"/></svg>
                </div>
                <span class="text-xs font-bold text-lime-700 text-center">Mi Carrito</span>
            </a>
            <a href="{{ route('user.buyer.orders') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-indigo-50 hover:bg-indigo-100 transition group border border-indigo-100">
                <div class="w-10 h-10 rounded-xl bg-indigo-500 flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                </div>
                <span class="text-xs font-bold text-indigo-700 text-center">Mis Pedidos</span>
            </a>
            <a href="{{ route('user.buyer.favorites') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-red-50 hover:bg-red-100 transition group border border-red-100">
                <div class="w-10 h-10 rounded-xl bg-red-500 flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                </div>
                <span class="text-xs font-bold text-red-700 text-center">Favoritos</span>
            </a>
            <a href="{{ route('user.buyer.profile') }}" class="flex flex-col items-center gap-2 p-4 rounded-xl bg-rose-50 hover:bg-rose-100 transition group border border-rose-100">
                <div class="w-10 h-10 rounded-xl bg-rose-500 flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <span class="text-xs font-bold text-rose-700 text-center">Mi Perfil</span>
            </a>
        </div>
    </div>

    {{-- Pedidos recientes --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-base font-black text-gray-800">Pedidos recientes</h2>
            <a href="{{ route('user.buyer.orders') }}" class="text-xs font-bold text-sky-600 hover:underline">Ver todos →</a>
        </div>

        @if(isset($pedidosRecientes) && $pedidosRecientes->count() > 0)
            <div class="space-y-3">
                @foreach($pedidosRecientes as $pedido)
                <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50 border border-gray-100 hover:border-sky-200 hover:bg-sky-50 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-sky-100 flex items-center justify-center text-sky-600 font-black text-sm">
                            #{{ $pedido->id }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">Pedido #{{ $pedido->id }}</p>
                            <p class="text-xs text-gray-500">{{ $pedido->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-black text-gray-900">${{ number_format($pedido->total, 0, ',', '.') }}</p>
                        @php
                            $estadoClases = [
                                'pendiente' => 'bg-amber-100 text-amber-700',
                                'en_proceso' => 'bg-sky-100 text-sky-700',
                                'entregado' => 'bg-lime-100 text-lime-700',
                                'cancelado' => 'bg-red-100 text-red-700',
                            ];
                        @endphp
                        <span class="text-[10px] font-black px-2 py-0.5 rounded-full {{ $estadoClases[$pedido->estado] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($pedido->estado) }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-10">
                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <p class="text-sm font-bold text-gray-400">Aún no tienes pedidos</p>
                <a href="{{ route('public.products.index') }}" class="mt-3 inline-block text-xs font-black text-sky-600 hover:underline">¡Empieza a comprar!</a>
            </div>
        @endif
    </div>

</div>
@endsection