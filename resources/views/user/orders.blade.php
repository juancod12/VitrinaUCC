@extends('layouts.userPanel')

@section('content')
<div class="space-y-6">

    <div>
        <h2 class="text-xl font-black text-gray-900">Mis Pedidos</h2>
        <p class="text-sm text-gray-500 mt-0.5">Historial y estado de tus compras en Vitrina UCC</p>
    </div>

    @if(isset($pedidos) && $pedidos->count() > 0)

    {{-- Filtros de estado --}}
    <div class="flex gap-2 flex-wrap" x-data="{ filtro: 'todos' }">
        @php
            $estados = [
                'todos' => ['label' => 'Todos', 'color' => 'bg-gray-100 text-gray-700'],
                'pendiente' => ['label' => 'Pendiente', 'color' => 'bg-amber-100 text-amber-700'],
                'en_proceso' => ['label' => 'En proceso', 'color' => 'bg-sky-100 text-sky-700'],
                'entregado' => ['label' => 'Entregados', 'color' => 'bg-lime-100 text-lime-700'],
                'cancelado' => ['label' => 'Cancelados', 'color' => 'bg-red-100 text-red-700'],
            ];
        @endphp
        @foreach($estados as $key => $estado)
            <button @click="filtro = '{{ $key }}'"
                class="px-4 py-1.5 rounded-full text-xs font-bold transition {{ $estado['color'] }}"
                :class="filtro === '{{ $key }}' ? 'ring-2 ring-offset-1 ring-sky-400' : ''">
                {{ $estado['label'] }}
            </button>
        @endforeach
    </div>

    {{-- Lista de pedidos --}}
    <div class="space-y-4">
        @foreach($pedidos as $pedido)
        @php
            $estadoClases = [
                'pendiente' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'dot' => 'bg-amber-400', 'icon' => '⏳'],
                'en_proceso' => ['bg' => 'bg-sky-100', 'text' => 'text-sky-700', 'dot' => 'bg-sky-400', 'icon' => '🚚'],
                'entregado' => ['bg' => 'bg-lime-100', 'text' => 'text-lime-700', 'dot' => 'bg-lime-400', 'icon' => '✅'],
                'cancelado' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'dot' => 'bg-red-400', 'icon' => '❌'],
            ];
            $clases = $estadoClases[$pedido->estado] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'dot' => 'bg-gray-400', 'icon' => '📦'];
        @endphp
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:border-sky-200 transition">
            {{-- Header del pedido --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50 bg-gray-50/50">
                <div class="flex items-center gap-4">
                    <div class="text-lg">{{ $clases['icon'] }}</div>
                    <div>
                        <p class="text-sm font-black text-gray-900">Pedido #{{ $pedido->id }}</p>
                        <p class="text-xs text-gray-400">{{ $pedido->created_at->format('d \d\e M\. Y — H:i') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-[10px] font-black px-3 py-1 rounded-full {{ $clases['bg'] }} {{ $clases['text'] }} flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full {{ $clases['dot'] }}"></span>
                        {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}
                    </span>
                    <span class="text-base font-black text-sky-700">${{ number_format($pedido->total, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Items del pedido --}}
            @if($pedido->items && $pedido->items->count() > 0)
            <div class="px-6 py-4">
                <div class="space-y-3">
                    @foreach($pedido->items->take(3) as $item)
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden">
                            @if($item->producto && $item->producto->imagen_principal)
                                <img src="{{ asset('storage/' . $item->producto->imagen_principal) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-sm">📦</div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-gray-800 truncate">{{ $item->producto->nombre ?? 'Producto' }}</p>
                            <p class="text-xs text-gray-400">x{{ $item->cantidad }} × ${{ number_format($item->precio_unitario, 0, ',', '.') }}</p>
                        </div>
                        <p class="text-sm font-black text-gray-700">${{ number_format($item->cantidad * $item->precio_unitario, 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                    @if($pedido->items->count() > 3)
                    <p class="text-xs text-gray-400 font-medium">+ {{ $pedido->items->count() - 3 }} productos más</p>
                    @endif
                </div>
            </div>
            @endif

            {{-- Footer del pedido --}}
            <div class="px-6 py-3 border-t border-gray-50 flex justify-between items-center">
                <p class="text-xs text-gray-400">
                    📍 {{ $pedido->direccion_entrega ?? 'Sin dirección registrada' }}
                </p>
                <a href="{{ route('user.buyer.orders.show', $pedido->id) }}"
                   class="text-xs font-bold text-sky-600 hover:underline">
                    Ver detalle →
                </a>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Paginación --}}
    <div class="flex justify-center">
        {{ $pedidos->links() }}
    </div>

    @else
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
        <div class="w-20 h-20 bg-indigo-50 rounded-3xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <h3 class="text-base font-black text-gray-700 mb-1">Aún no tienes pedidos</h3>
        <p class="text-sm text-gray-400 mb-6">Cuando hagas tu primera compra aparecerá aquí.</p>
        <a href="{{ route('public.products.index') }}"
           class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-bold px-6 py-3 rounded-xl text-sm shadow-md transition">
            Ir a la tienda
        </a>
    </div>
    @endif

</div>
@endsection