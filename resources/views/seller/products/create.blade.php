@extends('layouts.sellerPanel')

@section('content')
<div class="max-w-4xl mx-auto">
    @php
        $perfil = Auth::user()->perfilEmprendedor;
        $bloqueado = !$perfil || !$perfil->isComplete();
    @endphp

    @if($bloqueado)
        {{-- MENSAGE DE BLOQUEO --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-amber-100 p-8 text-center mt-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-amber-100 rounded-full mb-6">
                <span class="text-4xl">⚠️</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Perfil de Negocio Incompleto</h2>
            <p class="text-gray-600 dark:text-gray-400 max-w-sm mx-auto mb-8">
                Necesitas registrar el nombre, descripción y contacto de tu negocio antes de poder publicar productos.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('user.seller.business.index') }}" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition shadow-lg">
                        Completar datos del negocio
                </a>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('user.seller.products') }}" class="px-8 py-3 text-gray-500 font-medium">Regresar</a>
            </div>
        </div>
    @else
        {{-- FORMULARIO DE REGISTRO DE PRODUCTOS --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Crear Nuevo Producto</h2>
                <p class="text-sm text-gray-500 font-handwritten">Registra tu artículo para la Vitrina UCC.</p>
            </div>
            <a href="{{ route('user.seller.products')}}" class="text-gray-500 hover:text-gray-700 text-sm font-medium">&larr; Volver</a>
        </div>

        <form action="{{ route('user.seller.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Columna Izquierda: Datos --}}
                <div class="space-y-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                        <h3 class="text-xs font-bold text-blue-600 uppercase mb-4">Información General</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del Producto</label>
                                <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full rounded-lg border-gray-300 dark:bg-gray-700">
                            </div>

                            <div x-data="{ search: '', items: [ @foreach($categorias as $cat) { id: '{{ $cat->id }}', nombre: '{{ $cat->nombre }}' }, @endforeach ], get filtered() { return this.items.filter(i => i.nombre.toLowerCase().includes(this.search.toLowerCase())) } }">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoría</label>
                                <input type="text" x-model="search" placeholder="Filtrar categorías..." class="w-full mb-2 text-xs rounded-lg border-dashed border-gray-300 dark:bg-gray-800">
                                <select name="categoria_id" size="4" required class="w-full rounded-lg border-gray-300 dark:bg-gray-700">
                                    <template x-for="item in filtered" :key="item.id">
                                        <option :value="item.id" x-text="item.nombre" :selected="item.id == '{{ old('categoria_id') }}'"></option>
                                    </template>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                                <textarea name="descripcion" rows="4" class="w-full rounded-lg border-gray-300 dark:bg-gray-700">{{ old('descripcion') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Columna Derecha: Comercial e Imagen --}}
                <div class="space-y-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 shadow-sm">
                        <h3 class="text-xs font-bold text-blue-600 uppercase mb-4">Precio y Stock</h3>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Precio ($)</label>
                                <input type="number" step="0.01" name="precio" value="{{ old('precio') }}" required class="w-full rounded-lg border-gray-300 dark:bg-gray-700">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Stock</label>
                                <input type="number" name="stock" value="{{ old('stock', 1) }}" required class="w-full rounded-lg border-gray-300 dark:bg-gray-700">
                            </div>
                        </div>
                        <label class="block text-sm font-medium text-gray-700">Estado inicial</label>
                        <select name="estado" class="w-full rounded-lg border-gray-300 dark:bg-gray-700">
                            <option value="activo">Publicar ahora</option>
                            <option value="borrador">Guardar borrador</option>
                        </select>
                    </div>

                    {{-- IMAGEN CON PREVIEW ALPINE.JS --}}
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 shadow-sm text-center"
                         x-data="{ imageUrl: null, fileName: '' }">
                        <h3 class="text-xs font-bold text-blue-600 uppercase mb-4">Foto del Producto</h3>
                        <div class="relative min-h-[160px] border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-400 transition flex items-center justify-center bg-gray-50 dark:bg-gray-900/50">
                            <input type="file" name="imagen_principal" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" accept="image/*"
                                @change="const file = $event.target.files[0]; if (file) { fileName = file.name; const reader = new FileReader(); reader.onload = (e) => { imageUrl = e.target.result; }; reader.readAsDataURL(file); }">
                            <div class="z-10 pointer-events-none">
                                <div x-show="!imageUrl">
                                    <p class="text-xs text-gray-500">Haz clic para subir imagen</p>
                                </div>
                                <div x-show="imageUrl" x-cloak class="flex flex-col items-center">
                                    <img :src="imageUrl" class="h-32 w-32 object-cover rounded shadow-md border-2 border-blue-500">
                                    <p class="text-[10px] text-gray-400 mt-2 truncate w-32" x-text="fileName"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-gray-200">
                <button type="submit" class="px-12 py-3 text-white bg-blue-600 rounded-xl hover:bg-blue-700 font-bold shadow-lg transition active:scale-95">
                    Crear Producto
                </button>
            </div>
        </form>
    @endif
</div>

@push('styles')
<style> [x-cloak] { display: none !important; } </style>
@endpush
@endsection