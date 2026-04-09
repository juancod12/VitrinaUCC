@extends('layouts.userPanel')

@section('content')
<div class="space-y-6">

    <div class="flex items-center gap-3">
        <a href="{{ route('user.buyer.orders') }}" class="text-gray-400 hover:text-sky-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h2 class="text-xl font-black text-gray-900">Pedido #{{ $pedido->id }}</h2>
            <p class="text-sm text-gray-500">{{ $pedido->created_at->format('d \d\e F \d\e Y — H:i') }}</p>
        </div>
    </div>

    @php
        $estadoConfig = [
            'pendiente'  => ['color' => 'bg-amber-100 text-amber-700 border-amber-200', 'dot' => 'bg-amber-400', 'label' => 'Pendiente', 'steps' => 1],
            'en_proceso' => ['color' => 'bg-sky-100 text-sky-700 border-sky-200',       'dot' => 'bg-sky-400',   'label' => 'En proceso', 'steps' => 2],
            'entregado'  => ['color' => 'bg-lime-100 text-lime-700 border-lime-200',    'dot' => 'bg-lime-400',  'label' => 'Entregado',  'steps' => 3],
            'cancelado'  => ['color' => 'bg-red-100 text-red-700 border-red-200',       'dot' => 'bg-red-400',   'label' => 'Cancelado',  'steps' => 0],
        ];
        $config = $estadoConfig[$pedido->estado] ?? $estadoConfig['pendiente'];
    @endphp

    {{-- Estado y progreso --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-sm font-black text-gray-900">Estado del pedido</h3>
            <span class="text-xs font-black px-3 py-1.5 rounded-full border {{ $config['color'] }} flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full {{ $config['dot'] }}"></span>
                {{ $config['label'] }}
            </span>
        </div>

        @if($pedido->estado !== 'cancelado')
        {{-- Barra de progreso --}}
        <div class="relative">
            <div class="flex items-center justify-between mb-2">
                @php
                    $pasos = [
                        ['label' => 'Pedido recibido', 'icon' => '📋'],
                        ['label' => 'En preparación', 'icon' => '📦'],
                        ['label' => 'Entregado', 'icon' => '✅'],
                    ];
                @endphp
                @foreach($pasos as $i => $paso)
                <div class="flex flex-col items-center gap-1.5 flex-1">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl
                        {{ $i < $config['steps'] ? 'bg-sky-500 shadow-md shadow-sky-200' : ($i === $config['steps'] - 1 ? 'bg-sky-100' : 'bg-gray-100') }}">
                        {{ $paso['icon'] }}
                    </div>
                    <p class="text-[10px] font-bold text-center {{ $i < $config['steps'] ? 'text-sky-600' : 'text-gray-400' }}">
                        {{ $paso['label'] }}
                    </p>
                </div>
                @if(!$loop->last)
                <div class="h-0.5 flex-1 mx-1 mb-6 rounded {{ $i < $config['steps'] - 1 ? 'bg-sky-400' : 'bg-gray-100' }}"></div>
                @endif
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Productos --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:col-span-2">
            <h3 class="text-sm font-black text-gray-900 mb-4">Productos</h3>
            <div class="divide-y divide-gray-50">
                @foreach($pedido->items as $item)
                <div class="flex items-center gap-4 py-4">
                    <div class="w-16 h-16 rounded-xl bg-gray-100 flex-shrink-0 overflow-hidden border border-gray-100">
                        @if($item->producto && $item->producto->imagen_principal)
                            <img src="{{ asset('storage/' . $item->producto->imagen_principal) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-2xl">📦</div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-900">{{ $item->producto->nombre ?? 'Producto eliminado' }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Precio unitario: ${{ number_format($item->precio_unitario, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-400">Cantidad: {{ $item->cantidad }}</p>
                    </div>
                    <p class="text-base font-black text-sky-700">
                        ${{ number_format($item->precio_unitario * $item->cantidad, 0, ',', '.') }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Dirección --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="text-sm font-black text-gray-900 mb-3">Dirección de entrega</h3>
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-lg bg-sky-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                </div>
                <p class="text-sm text-gray-700 leading-relaxed">{{ $pedido->direccion_entrega ?? 'No especificada' }}</p>
            </div>
        </div>

        {{-- Resumen de pago --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="text-sm font-black text-gray-900 mb-3">Resumen de pago</h3>
            @php
                $envio = 5000;
                $subtotal = $pedido->total - $envio;
            @endphp
            <div class="space-y-2 text-sm">
                <div class="flex justify-between text-gray-600">
                    <span>Subtotal productos</span>
                    <span class="font-bold">${{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Envío</span>
                    <span class="font-bold">${{ number_format($envio, 0, ',', '.') }}</span>
                </div>
                <div class="border-t border-gray-100 pt-2 flex justify-between font-black text-gray-900">
                    <span>Total pagado</span>
                    <span class="text-sky-700 text-base">${{ number_format($pedido->total, 0, ',', '.') }}</span>
                </div>
                <div class="pt-2 flex justify-between items-center">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Método:</span>
                    <span class="text-xs text-gray-600 font-bold">{{ ucfirst(str_replace("_", " ", $pedido->metodo_pago ?? "contra_entrega")) }}</span>
                </div>
                @if($pedido->referencia_pago)
                <div class="flex justify-between items-center">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Referencia:</span>
                    <span class="text-xs font-mono font-black text-lime-700 bg-lime-50 px-2 py-0.5 rounded">{{ $pedido->referencia_pago }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Botón volver --}}
    <div class="text-center">
        <a href="{{ route('user.buyer.orders') }}"
           class="inline-flex items-center gap-2 text-sm font-bold text-sky-600 hover:underline">
            ← Ver todos mis pedidos
        </a>
    </div>

</div>
@endsection