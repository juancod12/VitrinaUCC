@extends('layouts.userPanel')

@section('content')
<div x-data="carrito()" class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-black text-gray-900">Mi Carrito</h2>
            <p class="text-sm text-gray-500 mt-0.5">Revisa tus productos antes de confirmar</p>
        </div>
        <a href="{{ route('public.products.index') }}"
           class="text-xs font-bold text-sky-600 hover:underline flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Seguir comprando
        </a>
    </div>

    @if(session()->has('cart') && count(session('cart')) > 0)
    <div class="flex flex-col lg:flex-row gap-6">

        {{-- Lista de productos --}}
        <div class="flex-1 space-y-4">
            @foreach(session('cart') as $id => $item)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex gap-4 group hover:border-sky-200 transition">
                {{-- Imagen --}}
                <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                    @if(isset($item['imagen']))
                        <img src="{{ asset('storage/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-2xl">📦</div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 truncate">{{ $item['nombre'] }}</h3>
                            <p class="text-xs text-gray-500">Por: {{ $item['comerciante'] ?? 'Vitrina UCC' }}</p>
                        </div>
                        <form method="POST" action="{{ route('user.buyer.cart.remove', $id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-300 hover:text-red-500 transition flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>
                    </div>

                    <div class="flex items-center justify-between mt-3">
                        {{-- Cantidad --}}
                        <form method="POST" action="{{ route('user.buyer.cart.update', $id) }}" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                <button type="submit" name="action" value="decrement" class="px-3 py-1.5 text-gray-500 hover:bg-gray-100 text-sm font-bold transition">−</button>
                                <span class="px-3 py-1.5 text-sm font-black text-gray-900 border-x border-gray-200 min-w-[36px] text-center">{{ $item['cantidad'] }}</span>
                                <button type="submit" name="action" value="increment" class="px-3 py-1.5 text-gray-500 hover:bg-gray-100 text-sm font-bold transition">+</button>
                            </div>
                        </form>

                        <p class="text-base font-black text-sky-700">
                            ${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Vaciar carrito --}}
            <form method="POST" action="{{ route('user.buyer.cart.clear') }}" class="text-right">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-xs text-red-400 hover:text-red-600 font-bold transition">
                    Vaciar carrito
                </button>
            </form>
        </div>

        {{-- Resumen --}}
        <div class="w-full lg:w-80 flex-shrink-0">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-6">
                <h3 class="text-base font-black text-gray-900 mb-5">Resumen del pedido</h3>

                @php
                    $subtotal = collect(session('cart'))->sum(fn($i) => $i['precio'] * $i['cantidad']);
                    $envio = 5000;
                    $total = $subtotal + $envio;
                @endphp

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-bold">${{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Envío estimado</span>
                        <span class="font-bold">${{ number_format($envio, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-100 pt-3 flex justify-between text-gray-900">
                        <span class="font-black">Total</span>
                        <span class="font-black text-lg text-sky-700">${{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <a href="{{ route('user.buyer.checkout') }}"
                   class="mt-5 w-full flex items-center justify-center gap-2 bg-gradient-to-r from-sky-600 to-sky-500 hover:from-sky-700 hover:to-sky-600 text-white font-black py-3.5 rounded-xl text-sm shadow-lg shadow-sky-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Confirmar pedido
                </a>

                <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-400">
                    <svg class="w-3.5 h-3.5 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Compra protegida por Vitrina UCC
                </div>
            </div>
        </div>
    </div>

    @else
    {{-- Carrito vacío --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
        <div class="w-20 h-20 bg-sky-50 rounded-3xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
        <h3 class="text-base font-black text-gray-700 mb-1">Tu carrito está vacío</h3>
        <p class="text-sm text-gray-400 mb-6">¡Explora los productos de nuestra comunidad!</p>
        <a href="{{ route('public.products.index') }}"
           class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-bold px-6 py-3 rounded-xl text-sm shadow-md shadow-sky-100 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            Explorar productos
        </a>
    </div>
    @endif

</div>

@push('scripts')
<script>
function carrito() {
    return {};
}
</script>
@endpush
@endsection