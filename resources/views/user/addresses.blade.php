@extends('layouts.userPanel')

@section('content')
<div class="space-y-6" x-data="{ modalAgregar: false }">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-black text-gray-900">Mis Direcciones</h2>
            <p class="text-sm text-gray-500 mt-0.5">Gestiona tus direcciones de entrega</p>
        </div>
        <button @click="modalAgregar = true"
            class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm shadow-md shadow-sky-100 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Agregar dirección
        </button>
    </div>

    @if(session('success'))
        <div class="px-4 py-3 bg-lime-50 border border-lime-200 rounded-xl text-lime-700 text-sm font-bold flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(isset($direcciones) && $direcciones->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($direcciones as $direccion)
        <div class="bg-white rounded-2xl border {{ $direccion->principal ? 'border-sky-300 shadow-sky-100' : 'border-gray-100' }} shadow-sm p-5 relative group">

            @if($direccion->principal)
            <span class="absolute top-4 right-4 text-[10px] font-black px-2 py-0.5 rounded-full bg-sky-100 text-sky-700 uppercase tracking-wider">
                Principal
            </span>
            @endif

            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl {{ $direccion->principal ? 'bg-sky-100' : 'bg-gray-100' }} flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 {{ $direccion->principal ? 'text-sky-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div class="flex-1 min-w-0 pr-12">
                    <p class="text-sm font-bold text-gray-900">{{ $direccion->direccion }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $direccion->ciudad }}, {{ $direccion->departamento }}</p>
                </div>
            </div>

            <div class="mt-4 flex gap-2">
                @if(!$direccion->principal)
                <form method="POST" action="{{ route('user.buyer.addresses.principal', $direccion->id) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="text-xs font-bold text-sky-600 hover:bg-sky-50 px-3 py-1.5 rounded-lg transition border border-sky-200">
                        Marcar como principal
                    </button>
                </form>
                @endif
                <form method="POST" action="{{ route('user.buyer.addresses.destroy', $direccion->id) }}"
                      onsubmit="return confirm('¿Eliminar esta dirección?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs font-bold text-red-400 hover:bg-red-50 px-3 py-1.5 rounded-lg transition border border-red-100">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
        <div class="w-20 h-20 bg-amber-50 rounded-3xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-amber-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h3 class="text-base font-black text-gray-700 mb-1">No tienes direcciones guardadas</h3>
        <p class="text-sm text-gray-400 mb-6">Agrega una dirección para agilizar tus compras.</p>
        <button @click="modalAgregar = true"
            class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-bold px-6 py-3 rounded-xl text-sm shadow-md transition">
            Agregar mi primera dirección
        </button>
    </div>
    @endif

    {{-- Modal agregar dirección --}}
    <div x-show="modalAgregar" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="modalAgregar = false"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 z-10"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-black text-gray-900">Nueva dirección</h3>
                <button @click="modalAgregar = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form method="POST" action="{{ route('user.buyer.addresses.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wider">Dirección</label>
                    <input type="text" name="direccion" placeholder="Calle 45 #12-34, Apto 201"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 text-sm outline-none transition" required>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wider">Ciudad</label>
                        <input type="text" name="ciudad" placeholder="Bogotá"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 text-sm outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wider">Departamento</label>
                        <input type="text" name="departamento" placeholder="Cundinamarca"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 text-sm outline-none transition" required>
                    </div>
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="principal" value="1" class="w-4 h-4 rounded text-sky-600 border-gray-300 focus:ring-sky-400">
                    <span class="text-sm text-gray-700 font-medium">Marcar como dirección principal</span>
                </label>
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 rounded-xl text-sm transition shadow-md">
                        Guardar dirección
                    </button>
                    <button type="button" @click="modalAgregar = false"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl text-sm transition">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection