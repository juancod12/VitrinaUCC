@extends('layouts.sellerPanel')

@section('content')
<div class="max-w-5xl mx-auto pb-12" x-data="{ editing: {{ $perfil->exists ? 'false' : 'true' }} }">
    
    {{-- MENSAJES DE ESTADO --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
             class="mb-6 flex items-center p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl shadow-sm transition">
            <span class="text-xl mr-3">✅</span>
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- CABECERA DE PERFIL --}}
    <div class="relative mb-8">
        <div class="h-48 w-full bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl shadow-lg overflow-hidden">
            @if($perfil && $perfil->banner)
                <img src="{{ asset('storage/' . $perfil->banner) }}" class="w-full h-full object-cover opacity-60">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <span class="text-white/20 text-6xl italic font-bold">Vitrina UCC</span>
                </div>
            @endif
        </div>
        
        <div class="absolute -bottom-6 left-8 flex items-end space-x-6">
            <div class="h-32 w-32 rounded-2xl border-4 border-white bg-white shadow-xl overflow-hidden flex items-center justify-center">
                @if($perfil && $perfil->logo)
                    <img src="{{ asset('storage/' . $perfil->logo) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-4xl">🏢</span>
                @endif
            </div>
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
                    {{ $perfil->nombre_negocio ?? 'Mi Negocio' }}
                </h1>
                <p class="text-white bg-blue-500/40 backdrop-blur-md px-3 py-1 rounded-full text-xs font-semibold inline-block border border-white/30">
                    {{ $perfil && $perfil->verificado ? '✓ Comercio Verificado' : 'Comercio en Proceso' }}
                </p>
            </div>
        </div>
    </div>

    <form action="{{ route('user.seller.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-12">
            
            {{-- COLUMNA IZQUIERDA: CONTACTO --}}
            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-6 flex items-center">
                        <span class="mr-2">📞</span> Contacto
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Teléfono WhatsApp</label>
                            <template x-if="!editing">
                                <p class="text-gray-700 dark:text-gray-200 font-medium py-2">{{ $perfil->telefono ?? 'No asignado' }}</p>
                            </template>
                            <input x-show="editing" type="text" name="telefono" value="{{ old('telefono', $perfil->telefono ?? '') }}" 
                                   class="w-full rounded-xl border-gray-200 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Correo Público</label>
                            <template x-if="!editing">
                                <p class="text-gray-700 dark:text-gray-200 font-medium py-2">{{ $perfil->correo_contacto ?? 'No asignado' }}</p>
                            </template>
                            <input x-show="editing" type="email" name="correo_contacto" value="{{ old('correo_contacto', $perfil->correo_contacto ?? '') }}" 
                                   class="w-full rounded-xl border-gray-200 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Sitio Web / Redes</label>
                            <template x-if="!editing">
                                <p class="text-blue-600 dark:text-blue-400 font-medium py-2 truncate">{{ $perfil->sitio_web ?? 'No asignado' }}</p>
                            </template>
                            <input x-show="editing" type="url" name="sitio_web" value="{{ old('sitio_web', $perfil->sitio_web ?? '') }}" 
                                   placeholder="https://..." class="w-full rounded-xl border-gray-200 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                    </div>
                </div>
            </div>

            {{-- COLUMNA DERECHA: BIO Y ASSETS --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-6">Detalles del Emprendimiento</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nombre del Negocio</label>
                            <template x-if="!editing">
                                <p class="text-xl font-bold text-gray-800 dark:text-white">{{ $perfil->nombre_negocio ?? 'Sin nombre' }}</p>
                            </template>
                            <input x-show="editing" type="text" name="nombre_negocio" value="{{ old('nombre_negocio', $perfil->nombre_negocio ?? '') }}" 
                                   class="w-full text-lg font-semibold rounded-xl border-gray-200 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Descripción de la Marca</label>
                            <template x-if="!editing">
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $perfil->descripcion ?? 'Sin descripción' }}</p>
                            </template>
                            <textarea x-show="editing" name="descripcion" rows="5" 
                                      class="w-full rounded-xl border-gray-200 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">{{ old('descripcion', $perfil->descripcion ?? '') }}</textarea>
                        </div>
                    </div>

                    {{-- FILES (Solo visibles en modo edición) --}}
                    <div x-show="editing" class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8" x-transition>
                        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-dashed border-gray-300 dark:border-gray-600">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Cambiar Logo</label>
                            <input type="file" name="logo" class="text-xs w-full text-gray-400">
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-dashed border-gray-300 dark:border-gray-600">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Cambiar Banner</label>
                            <input type="file" name="banner" class="text-xs w-full text-gray-400">
                        </div>
                    </div>
                </div>

                {{-- BOTONES DE ACCIÓN --}}
                <div class="flex flex-col sm:flex-row justify-end items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    
                    {{-- Botón Cancelar (Solo en modo edición y si el perfil existe) --}}
                    @if($perfil->exists)
                        <button x-show="editing" type="button" @click="editing = false" 
                                class="w-full sm:w-auto px-6 py-4 text-gray-500 font-semibold hover:text-red-500 transition">
                            Cancelar
                        </button>
                    @endif

                    {{-- Botón Editar (Solo en modo lectura) --}}
                    <button x-show="!editing" type="button" @click="editing = true" 
                            class="w-full sm:w-auto px-10 py-4 bg-gray-800 text-white font-bold rounded-2xl shadow-lg hover:bg-gray-900 transition active:scale-95">
                        Editar Perfil
                    </button>
                    
                    {{-- Botón Guardar (Solo en modo edición) --}}
                    <button x-show="editing" type="submit" 
                            class="w-full sm:w-auto px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl transition-all active:scale-95">
                        {{ $perfil->exists ? 'Guardar Cambios' : 'Crear Perfil de Negocio' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection