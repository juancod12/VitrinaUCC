@extends('layouts.sellerPanel')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Mis Productos</h2>
            <p class="text-sm text-gray-500">Gestiona tu catálogo, stock y precios de venta.</p>
        </div>
        
        <a href="{{ route('user.seller.products.create') }}"
            class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm transition-all duration-200">
            <span class="mr-2 text-lg">+</span>
            Nuevo Producto
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Categoría</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    {{-- Iteración de productos --}}
                    @forelse($productos as $producto)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-12 w-12 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden border border-gray-200">
                                    @if($producto->imagen_principal)
                                        <img src="{{ asset('storage/' . $producto->imagen_principal) }}" alt="{{ $producto->nombre }}" class="h-full w-full object-cover">
                                    @else
                                        <span class="flex items-center justify-center h-full text-xl text-gray-400">📦</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $producto->nombre }}</div>
                                    <div class="text-xs text-gray-500">{{ Str::limit($producto->descripcion, 40) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">
                            ${{ number_format($producto->precio, 2) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm @if($producto->stock <= 5) text-red-600 font-bold @else text-gray-600 dark:text-gray-400 @endif">
                                {{ $producto->stock }} unds.
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($producto->estado === 'activo')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    ● Publicado
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    ● Borrador
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition text-sm font-medium">Editar</a>
                            <button class="text-red-500 hover:text-red-700 transition text-sm font-medium">Eliminar</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <span class="text-4xl mb-2">🔎</span>
                                <p>No tienes productos registrados aún.</p>
                                <a href="{{ route('user.seller.products.create') }}" class="text-blue-600 mt-2 hover:underline">Crea tu primer producto aquí</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Paginación (Si existe) --}}
        @if($productos->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $productos->links() }}
            </div>
        @endif
    </div>
</div>
@endsection