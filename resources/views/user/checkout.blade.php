@extends('layouts.userPanel')

@section('content')
<div class="space-y-6" x-data="checkout()">

    <div>
        <h2 class="text-xl font-black text-gray-900">Confirmar Pedido</h2>
        <p class="text-sm text-gray-500 mt-0.5">Revisa todo antes de finalizar tu compra</p>
    </div>

    <form method="POST" action="{{ route('user.buyer.checkout.place') }}" class="flex flex-col lg:flex-row gap-6">
        @csrf

        <div class="flex-1 space-y-5">

            {{-- Paso 1: Dirección --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-black text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 bg-sky-600 text-white rounded-full flex items-center justify-center text-xs font-black">1</span>
                    Dirección de entrega
                </h3>

                @if(isset($direcciones) && $direcciones->count() > 0)
                <div class="space-y-3 mb-4">
                    @foreach($direcciones as $direccion)
                    <label class="flex items-start gap-3 p-4 rounded-xl border cursor-pointer transition {{ $direccion->principal ? 'border-sky-400 bg-sky-50' : 'border-gray-200 hover:border-sky-200' }}">
                        <input type="radio" name="direccion_entrega"
                            value="{{ $direccion->direccion }}, {{ $direccion->ciudad }}, {{ $direccion->departamento }}"
                            {{ $direccion->principal ? 'checked' : '' }}
                            class="mt-0.5 text-sky-600">
                        <div>
                            <p class="text-sm font-bold text-gray-800">{{ $direccion->direccion }}</p>
                            <p class="text-xs text-gray-500">{{ $direccion->ciudad }}, {{ $direccion->departamento }}</p>
                            @if($direccion->principal)<span class="text-[10px] font-black text-sky-600 uppercase">Principal</span>@endif
                        </div>
                    </label>
                    @endforeach
                </div>
                @else
                <input type="text" name="direccion_entrega" placeholder="Ej: Calle 45 #12-34, Villavicencio, Meta"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-sky-400 text-sm outline-none" required>
                @error('direccion_entrega')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                @endif
            </div>

            {{-- Paso 2: Productos --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-black text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 bg-sky-600 text-white rounded-full flex items-center justify-center text-xs font-black">2</span>
                    Productos del pedido
                </h3>
                <div class="divide-y divide-gray-50">
                    @foreach($cart as $id => $item)
                    <div class="flex items-center gap-4 py-3">
                        <div class="w-12 h-12 rounded-xl bg-gray-100 flex-shrink-0 overflow-hidden">
                            @if(isset($item['imagen']) && $item['imagen'])
                                <img src="{{ asset('storage/' . $item['imagen']) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-lg">📦</div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-800">{{ $item['nombre'] }}</p>
                            <p class="text-xs text-gray-400">Cantidad: {{ $item['cantidad'] }}</p>
                        </div>
                        <p class="text-sm font-black text-gray-800">${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Paso 3: Método de pago --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-black text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 bg-sky-600 text-white rounded-full flex items-center justify-center text-xs font-black">3</span>
                    Método de pago
                </h3>

                <div class="space-y-3">
                    {{-- PSE --}}
                    <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition"
                           :class="metodoPago === 'pse' ? 'border-sky-500 bg-sky-50' : 'border-gray-100 hover:border-sky-200'">
                        <input type="radio" name="metodo_pago" value="pse" x-model="metodoPago" class="text-sky-600">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-black text-gray-900">PSE — Débito bancario</p>
                            <p class="text-xs text-gray-500">Paga desde tu cuenta bancaria</p>
                        </div>
                        <span class="text-[10px] font-black bg-blue-100 text-blue-700 px-2 py-1 rounded-full">Sin costo extra</span>
                    </label>

                    {{-- Tarjeta --}}
                    <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition"
                           :class="metodoPago === 'tarjeta' ? 'border-sky-500 bg-sky-50' : 'border-gray-100 hover:border-sky-200'">
                        <input type="radio" name="metodo_pago" value="tarjeta" x-model="metodoPago" class="text-sky-600">
                        <div class="w-10 h-10 bg-gradient-to-br from-violet-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-black text-gray-900">Tarjeta crédito / débito</p>
                            <p class="text-xs text-gray-500">Visa, Mastercard, American Express</p>
                        </div>
                        <div class="flex gap-1">
                            <span class="text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-100 px-1.5 py-0.5 rounded">VISA</span>
                            <span class="text-[10px] font-bold bg-orange-50 text-orange-700 border border-orange-100 px-1.5 py-0.5 rounded">MC</span>
                        </div>
                    </label>

                    {{-- Contra entrega --}}
                    <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition"
                           :class="metodoPago === 'contra_entrega' ? 'border-sky-500 bg-sky-50' : 'border-gray-100 hover:border-sky-200'">
                        <input type="radio" name="metodo_pago" value="contra_entrega" x-model="metodoPago" class="text-sky-600">
                        <div class="w-10 h-10 bg-lime-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-gray-900">Contra entrega</p>
                            <p class="text-xs text-gray-500">Paga en efectivo al recibir</p>
                        </div>
                    </label>
                </div>

                @error('metodo_pago')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror

                {{-- Panel PSE --}}
                <div x-show="metodoPago === 'pse'" x-cloak class="mt-5 space-y-3 p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <p class="text-xs font-black text-blue-800 uppercase tracking-wider mb-2">Datos PSE (simulado)</p>
                    <select class="w-full px-4 py-3 rounded-xl border border-blue-200 bg-white text-sm outline-none">
                        <option value="">Selecciona tu banco</option>
                        <option>Bancolombia</option><option>Banco de Bogotá</option>
                        <option>Davivienda</option><option>BBVA</option>
                        <option>Nequi</option><option>Banco de Occidente</option>
                    </select>
                    <input type="text" placeholder="Número de cédula" class="w-full px-4 py-3 rounded-xl border border-blue-200 bg-white text-sm outline-none">
                    <p class="text-xs text-blue-700 bg-white p-3 rounded-lg border border-blue-100">ℹ️ Serás redirigido a tu banco para autorizar el pago de forma segura.</p>
                </div>

                {{-- Panel Tarjeta --}}
                <div x-show="metodoPago === 'tarjeta'" x-cloak class="mt-5 space-y-3 p-4 bg-violet-50 rounded-xl border border-violet-100">
                    <p class="text-xs font-black text-violet-800 uppercase tracking-wider mb-2">Datos de tarjeta (simulado)</p>
                    <input type="text" placeholder="Número de tarjeta" maxlength="19"
                           class="w-full px-4 py-3 rounded-xl border border-violet-200 bg-white text-sm outline-none font-mono tracking-widest"
                           @input="formatCard($event)">
                    <input type="text" placeholder="Nombre en la tarjeta" class="w-full px-4 py-3 rounded-xl border border-violet-200 bg-white text-sm outline-none">
                    <div class="grid grid-cols-2 gap-3">
                        <input type="text" placeholder="MM/AA" maxlength="5" class="px-4 py-3 rounded-xl border border-violet-200 bg-white text-sm outline-none">
                        <input type="text" placeholder="CVV" maxlength="4" class="px-4 py-3 rounded-xl border border-violet-200 bg-white text-sm outline-none font-mono">
                    </div>
                    <p class="text-xs text-violet-700 bg-white p-3 rounded-lg border border-violet-100">🔒 Pago simulado — tus datos no son procesados realmente.</p>
                </div>
            </div>
        </div>

        {{-- Resumen lateral --}}
        <div class="w-full lg:w-80 flex-shrink-0">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-6">
                <h3 class="text-base font-black text-gray-900 mb-5">Total del pedido</h3>

                @php $envio = 5000; $total = $subtotal + $envio; @endphp

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between text-gray-600">
                        <span>Productos ({{ collect($cart)->sum('cantidad') }})</span>
                        <span class="font-bold">${{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Envío estimado</span>
                        <span class="font-bold">${{ number_format($envio, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-100 pt-3 flex justify-between">
                        <span class="font-black text-gray-900">Total</span>
                        <span class="font-black text-xl text-sky-700">${{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-4 p-3 rounded-xl text-xs font-medium text-center transition"
                     :class="{
                        'bg-blue-50 text-blue-700': metodoPago === 'pse',
                        'bg-violet-50 text-violet-700': metodoPago === 'tarjeta',
                        'bg-lime-50 text-lime-700': metodoPago === 'contra_entrega',
                        'bg-gray-50 text-gray-400': !metodoPago
                     }">
                    <span x-show="!metodoPago">Selecciona un método de pago</span>
                    <span x-show="metodoPago === 'pse'">💳 PSE — Transferencia bancaria</span>
                    <span x-show="metodoPago === 'tarjeta'">💳 Tarjeta de crédito/débito</span>
                    <span x-show="metodoPago === 'contra_entrega'">💵 Pago en efectivo al recibir</span>
                </div>

                <button type="submit"
                    :disabled="!metodoPago"
                    :class="metodoPago ? 'opacity-100 cursor-pointer hover:from-lime-600 hover:to-lime-700' : 'opacity-40 cursor-not-allowed'"
                    class="mt-5 w-full flex items-center justify-center gap-2 bg-gradient-to-r from-lime-500 to-lime-600 text-white font-black py-4 rounded-xl text-sm shadow-lg shadow-lime-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Confirmar pedido
                </button>

                <a href="{{ route('user.buyer.cart') }}" class="mt-3 w-full flex items-center justify-center text-xs font-bold text-gray-500 hover:text-gray-700 py-2 transition">
                    ← Volver al carrito
                </a>

                <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-center gap-2 text-xs text-gray-400">
                    <svg class="w-3.5 h-3.5 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Compra 100% segura — Vitrina UCC
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function checkout() {
    return {
        metodoPago: '',
        formatCard(e) {
            let val = e.target.value.replace(/\D/g, '').slice(0, 16);
            e.target.value = val.match(/.{1,4}/g)?.join(' ') ?? val;
        }
    }
}
</script>
@endpush
@endsection
