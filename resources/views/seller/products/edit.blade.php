@extends('layouts.sellerPanel')

@section('content')
<div class="max-w-5xl mx-auto pb-12">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Editar Producto</h2>
            <p class="text-sm text-gray-500">Actualiza la información y fotos de tu artículo.</p>
        </div>
        <a href="{{ route('user.seller.products') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium">&larr; Volver</a>
    </div>

    <form action="{{ route('user.seller.products.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- COLUMNA IZQUIERDA: DATOS --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="text-xs font-bold text-blue-600 uppercase mb-6">Información General</h3>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre del Producto</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required 
                                   class="w-full rounded-xl border-gray-200 focus:ring-blue-500 dark:bg-gray-700">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                            <textarea name="descripcion" rows="4" 
                                      class="w-full rounded-xl border-gray-200 focus:ring-blue-500 dark:bg-gray-700">{{ old('descripcion', $producto->descripcion) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- SECCIÓN DE IMÁGENES (CARRUSEL/GALERÍA) --}}
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="text-xs font-bold text-blue-600 uppercase mb-4">Galería de Imágenes</h3>
                    
                    {{-- Imágenes actuales --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        {{-- Imagen Principal --}}
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $producto->imagen_principal) }}" class="h-32 w-full object-cover rounded-xl border-2 border-blue-500">
                            <span class="absolute top-2 left-2 bg-blue-500 text-white text-[10px] px-2 py-1 rounded-md">Principal</span>
                        </div>

                        {{-- Imágenes Adicionales del Producto --}}
                        @foreach($producto->imagenes as $img)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $img->url) }}" class="h-32 w-full object-cover rounded-xl border border-gray-200">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition rounded-xl flex items-center justify-center">
                                    {{-- Checkbox para eliminar --}}
                                    <label class="inline-flex items-center text-white text-xs cursor-pointer">
                                        <input type="checkbox" name="eliminar_imagenes[]" value="{{ $img->id }}" class="rounded text-red-500 mr-1"> Eliminar
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Cargar Nuevas Imágenes --}}
                    <div x-data="{ files: [] }" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Añadir más imágenes</label>
                        <div class="relative h-32 border-2 border-dashed border-gray-300 rounded-2xl flex items-center justify-center bg-gray-50 hover:bg-gray-100 transition">
                            <input type="file" name="imagenes_adicionales[]" multiple accept="image/*" 
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                   @change="files = Array.from($event.target.files)">
                            <div class="text-center">
                                <span class="text-2xl text-gray-400">+</span>
                                <p class="text-xs text-gray-500" x-text="files.length > 0 ? files.length + ' archivos seleccionados' : 'Haz clic para subir fotos adicionales'"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- COLUMNA DERECHA: COMERCIAL --}}
            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h3 class="text-xs font-bold text-blue-600 uppercase mb-4">Precio y Stock</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Precio ($)</label>
                            <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" required 
                                   class="w-full rounded-xl border-gray-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stock Disponible</label>
                            <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" required 
                                   class="w-full rounded-xl border-gray-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" class="w-full rounded-xl border-gray-200">
                                <option value="activo" {{ $producto->estado == 'activo' ? 'selected' : '' }}>Publicado</option>
                                <option value="inactivo" {{ $producto->estado == 'inactivo' ? 'selected' : '' }}>inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl transition active:scale-95">
                    Guardar Cambios
                </button>
            </div>
        </div>
    </form>
</div>
@endsection