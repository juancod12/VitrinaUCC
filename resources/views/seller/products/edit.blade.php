@extends('layouts.sellerPanel')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Crear Nuevo Producto</h2>
            <p class="text-sm text-gray-500">Llena los detalles técnicos y comerciales de tu artículo.</p>
        </div>
        <a href="#" class="text-gray-500 hover:text-gray-700 text-sm font-medium">
            &larr; Volver a la lista
        </a>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <h3 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-4">Información General</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre del Producto</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Ej: Café Orgánico 500g" 
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-blue-500 focus:ring-blue-500 transition">
                            <p class="mt-1 text-xs text-gray-400 italic text-right">El slug se generará automáticamente.</p>
                        </div>

                        <div>
                            <label for="categoria_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categoría</label>
                            <select name="categoria_id" id="categoria_id" 
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-blue-500 focus:ring-blue-500 transition">
                                <option value="">Selecciona una categoría</option>
                                {{-- Aquí iterarías sobre $categorias --}}
                                <option value="1">Alimentos</option>
                                <option value="2">Artesanías</option>
                            </select>
                        </div>

                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción Detallada</label>
                            <textarea name="descripcion" id="descripcion" rows="4" placeholder="Describe los beneficios y características..."
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-blue-500 focus:ring-blue-500 transition"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <h3 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-4">Inventario y Precio</h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="precio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio ($)</label>
                            <input type="number" step="0.01" name="precio" id="precio" placeholder="0.00"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-blue-500 focus:ring-blue-500 transition">
                        </div>
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stock Inicial</label>
                            <input type="number" name="stock" id="stock" placeholder="0"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-blue-500 focus:ring-blue-500 transition">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado inicial</label>
                        <select name="estado" id="estado" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-blue-500 focus:ring-blue-500 transition">
                            <option value="activo">Publicado inmediatamente</option>
                            <option value="borrador">Guardar como borrador</option>
                        </select>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <h3 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-4">Imagen del Producto</h3>
                    
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-blue-400 transition cursor-pointer">
                        <div class="space-y-1 text-center">
                            <span class="text-3xl">📸</span>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                <label for="imagen_principal" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span>Subir archivo</span>
                                    <input id="imagen_principal" name="imagen_principal" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">o arrastrar y soltar</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 10MB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <button type="button" class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Cancelar
            </button>
            <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm transition">
                Guardar Producto
            </button>
        </div>
    </form>
</div>
@endsection
