@extends('layouts.sellerPanel')

@section('content')
<div class="max-w-5xl mx-auto pb-10">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Mis Publicaciones</h1>
            <p class="text-gray-500">Gestiona el contenido que ven tus clientes en la vitrina.</p>
        </div>
        <a href="{{ route('user.seller.publications.create') }}"
            class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-200 transition active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
            </svg>
            Crear Publicación
        </a>
    </div>

    {{-- Grid de Publicaciones --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($publicaciones as $pub)
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                
                {{-- Multimedia Preview --}}
                <div class="relative h-48 bg-gray-200">
                    @if($pub->tipo_multimedia == 'imagen')
                        <img src="{{ asset('storage/'.$pub->multimedia) }}" class="w-full h-full object-cover">
                    @elseif($pub->tipo_multimedia == 'video')
                        <div class="flex items-center justify-center h-full bg-black">
                            <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168l4.74 3.16a1 1 0 010 1.664l-4.74 3.161A1 1 0 018 14.332V7.668a1 1 0 011.555-.832z"/></svg>
                        </div>
                    @else
                        <div class="flex items-center justify-center h-full bg-indigo-50 text-indigo-200">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16m-7 6h7"/></svg>
                        </div>
                    @endif
                    
                    {{-- Badge de Estado --}}
                    <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm 
                        {{ $pub->estado == 'activo' ? 'bg-green-100 text-green-600' : 'bg-amber-100 text-amber-600' }}">
                        {{ $pub->estado }}
                    </span>
                </div>

                {{-- Contenido --}}
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-[10px] font-bold text-indigo-500 uppercase">{{ $pub->seccion ?? 'General' }}</span>
                        <span class="text-[10px] text-gray-400">{{ $pub->created_at->diffForHumans() }}</span>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white leading-tight mb-2 line-clamp-2">{{ $pub->titulo }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-4">{{ $pub->contenido }}</p>

                    {{-- Footer de la card: Stats --}}
                    <div class="flex items-center justify-between pt-4 border-t border-gray-50 dark:border-gray-700">
                        <div class="flex space-x-4">
                            <div class="flex items-center text-gray-400">
                                <span class="text-xs mr-1">❤️</span>
                                <span class="text-xs font-medium">{{ $pub->favoritos_count ?? 0 }}</span>
                            </div>
                            <div class="flex items-center text-gray-400">
                                <span class="text-xs mr-1">💬</span>
                                <span class="text-xs font-medium">{{ $pub->comentarios_count ?? 0 }}</span>
                            </div>
                        </div>
                        
                        {{-- Acciones --}}
                        <div class="flex space-x-2">
                            <a href="{{ route('user.seller.publications.edit', $pub->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <form action="{{ route('user.seller.publications.destroy', $pub->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar publicación?')" class="p-2 text-red-400 hover:bg-red-50 rounded-lg transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 2v4h4"/></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">No hay publicaciones</h3>
                <p class="text-gray-500">Comienza a interactuar con tus seguidores hoy mismo.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection