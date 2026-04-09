@extends('layouts.app')

@section('content')
<div class="bg-[#FDFDFC] min-h-screen pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-10">
            
            <aside class="w-full lg:w-1/4">
                <div class="sticky top-6 space-y-8">
                    <form action="{{ route('public.products.index') }}" method="GET" class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="¿Qué buscas hoy?" 
                            class="w-full pl-10 pr-4 py-3 rounded-xl border-none shadow-sm focus:ring-2 focus:ring-[#0097d9] bg-white text-sm">
                        <button type="submit" class="absolute left-3 top-3.5 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </form>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-4 border-b pb-2">Explorar</h3>
                        <nav class="space-y-1">
                            <a href="{{ route('public.products.index') }}" 
                               class="flex items-center justify-between p-2 rounded-lg {{ !request('categoria') ? 'bg-blue-50 text-[#0097d9] font-bold' : 'text-gray-600 hover:bg-blue-50' }}">
                                <span>Todas</span>
                            </a>
                            @foreach($categorias as $cat)
                            <a href="{{ route('public.products.index', ['categoria' => $cat->slug]) }}" 
                               class="flex items-center justify-between group p-2 rounded-lg {{ request('categoria') == $cat->slug ? 'bg-blue-50 text-[#0097d9] font-bold' : 'text-gray-600 hover:bg-blue-50' }} transition">
                                <span class="group-hover:text-[#0097d9] font-medium">{{ $cat->nombre }}</span>
                                <span class="text-xs {{ request('categoria') == $cat->slug ? 'bg-[#0097d9] text-white' : 'bg-gray-100 text-gray-500' }} px-2 py-0.5 rounded-full">
                                    {{ $cat->productos_count }}
                                </span>
                            </a>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </aside>

            <main class="w-full lg:w-3/4">
                <div class="flex items-center justify-between mb-6">
                    <p class="text-gray-500 text-sm">Mostrando <span class="font-bold text-gray-800">{{ $productos->total() }}</span> productos locales</p>
                    
                    <form action="{{ route('public.products.index') }}" method="GET" id="sortForm">
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('categoria')) <input type="hidden" name="categoria" value="{{ request('categoria') }}"> @endif
                        <select name="sort" onchange="this.form.submit()" class="bg-transparent text-xs font-bold text-gray-500 uppercase tracking-widest border-none focus:ring-0 cursor-pointer">
                            <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Más recientes</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Menor precio</option>
                        </select>
                    </form>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                    @forelse($productos as $producto)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 group border border-gray-100 flex flex-col h-full">
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="{{ asset('storage/' . $producto->imagen_principal) }}" alt="{{ $producto->nombre }}" 
                                class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            
                            <div class="absolute top-4 left-4 flex flex-col gap-2">
                                <span class="bg-[#84cc16] text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-tighter shadow-lg">
                                    {{ $producto->stock > 0 ? 'Disponible' : 'Agotado' }}
                                </span>
                            </div>

                            <button onclick="toggleLike({{ $producto->id }}, this)" 
                                class="absolute top-4 right-4 p-2 bg-white/90 backdrop-blur-md rounded-full {{ $producto->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-400' }} hover:text-red-500 transition shadow-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                            </button>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-[10px] font-bold text-[#0097d9] uppercase tracking-widest">{{ $producto->categoria->nombre }}</span>
                            </div>

                            <h2 class="text-lg font-bold text-gray-800 mb-1 leading-tight group-hover:text-[#0097d9] transition">
                                {{ $producto->nombre }}
                            </h2>
                            <p class="text-xs text-gray-400 mb-4">Por: <span class="text-gray-600 font-semibold">{{ $producto->emprendedor->nombre_negocio }}</span></p>

                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-50">
                                <div>
                                    <span class="text-2xl font-black text-gray-900">$ {{ number_format($producto->precio, 0, ',', '.') }}</span>
                                </div>
                                <a href="#" class="bg-[#84cc16] hover:bg-[#74b614] hover:scale-110 transition-all text-white p-3 rounded-2xl shadow-lg shadow-[#84cc16]/30">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-span-full text-center py-20">
                            <p class="text-gray-400">No se encontraron productos con esos criterios.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-10">
                    {{ $productos->links() }}
                </div>
            </main>
        </div>
    </div>
</div>

<script>
function toggleLike(id, btn) {
    fetch(`/productos/${id}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if(response.status === 401) return alert('Inicia sesión para guardar favoritos');
        return response.json();
    })
    .then(data => {
        if(data.status === 'added') btn.classList.add('text-red-500');
        else btn.classList.remove('text-red-500');
    });
}
</script>
@endsection