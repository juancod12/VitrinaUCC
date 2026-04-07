@extends('layouts.app')

@section('content')
<div class="bg-[#FDFDFC] min-h-screen pb-20">
    <div class="relative bg-[#0097d9] py-16 mb-10 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1556740734-7f9a2b7a0f40?q=80&w=1200" class="w-full h-full object-cover" alt="background">
        </div>
        <div class="max-w-7xl mx-auto px-6 relative text-center md:text-left">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
                Impulsa el Comercio <span class="text-[#d9f99d]">Local UCC</span>
            </h1>
            <p class="text-blue-50 text-lg max-w-2xl">
                Descubre productos únicos creados por el talento de nuestra comunidad. Calidad, confianza y apoyo directo.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-10">
            
            <aside class="w-full lg:w-1/4">
                <div class="sticky top-6 space-y-8">
                    <div class="relative">
                        <input type="text" placeholder="¿Qué buscas hoy?" 
                            class="w-full pl-10 pr-4 py-3 rounded-xl border-none shadow-sm focus:ring-2 focus:ring-[#0097d9] bg-white text-sm">
                        <svg class="w-5 h-5 absolute left-3 top-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-4 border-b pb-2">Explorar</h3>
                        <nav class="space-y-1">
                            <a href="#" class="flex items-center justify-between group p-2 rounded-lg hover:bg-blue-50 transition">
                                <span class="text-gray-600 group-hover:text-[#0097d9] font-medium">Artesanías</span>
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">12</span>
                            </a>
                            <a href="#" class="flex items-center justify-between group p-2 rounded-lg bg-blue-50">
                                <span class="text-[#0097d9] font-bold">Gastronomía</span>
                                <span class="text-xs bg-[#0097d9] text-white px-2 py-0.5 rounded-full">24</span>
                            </a>
                            <a href="#" class="flex items-center justify-between group p-2 rounded-lg hover:bg-blue-50 transition">
                                <span class="text-gray-600 group-hover:text-[#0097d9] font-medium">Moda Sostenible</span>
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">8</span>
                            </a>
                        </nav>
                    </div>

                    <div class="bg-[#84cc16]/10 p-5 rounded-2xl border border-[#84cc16]/20">
                        <div class="flex items-center mb-2">
                            <span class="text-[#84cc16]">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h.01a1 1 0 100-2H10zm3 0a1 1 0 000 2h.01a1 1 0 100-2H13zM7 13a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h.01a1 1 0 100-2H10zm3 0a1 1 0 000 2h.01a1 1 0 100-2H13z" clip-rule="evenodd"/></svg>
                            </span>
                            <span class="ml-2 font-bold text-gray-800">Compra Segura</span>
                        </div>
                        <p class="text-[11px] text-gray-600 leading-relaxed">Cada comerciante ha sido verificado por la comunidad UCC para garantizar tu satisfacción.</p>
                    </div>
                </div>
            </aside>

            <main class="w-full lg:w-3/4">
                <div class="flex items-center justify-between mb-6">
                    <p class="text-gray-500 text-sm">Mostrando <span class="font-bold text-gray-800">32</span> productos locales</p>
                    <select class="bg-transparent text-xs font-bold text-gray-500 uppercase tracking-widest border-none focus:ring-0 cursor-pointer">
                        <option>Más recientes</option>
                        <option>Menor precio</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                    
                    @foreach($productos as $producto)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 group border border-gray-100 flex flex-col h-full">
                        <div class="relative overflow-hidden aspect-[4/3]">
                            <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" 
                                class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            
                            <div class="absolute top-4 left-4 flex flex-col gap-2">
                                <span class="bg-[#84cc16] text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-tighter shadow-lg">
                                    {{ $producto->badge ?? 'Destacado' }}
                                </span>
                            </div>

                            <button class="absolute top-4 right-4 p-2 bg-white/90 backdrop-blur-md rounded-full text-gray-400 hover:text-red-500 transition shadow-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                            </button>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-[10px] font-bold text-[#0097d9] uppercase tracking-widest">{{ $producto->categoria }}</span>
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span class="text-[10px] text-gray-400 ml-1">4.9</span>
                                </div>
                            </div>

                            <h2 class="text-lg font-bold text-gray-800 mb-1 leading-tight group-hover:text-[#0097d9] transition">
                                {{ $producto->nombre }}
                            </h2>
                            <p class="text-xs text-gray-400 mb-4">Por: <span class="text-gray-600 font-semibold">{{ $producto->comerciante }}</span></p>

                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-50">
                                <div>
                                    <span class="text-2xl font-black text-gray-900">$ {{ number_format($producto->precio, 0, ',', '.') }}</span>
                                </div>
                                <button class="bg-[#84cc16] hover:bg-[#74b614] hover:scale-110 transition-all text-white p-3 rounded-2xl shadow-lg shadow-[#84cc16]/30">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="mt-16 text-center">
                    <button class="bg-white border-2 border-gray-100 text-gray-500 font-bold py-4 px-10 rounded-2xl hover:border-[#0097d9] hover:text-[#0097d9] transition-all shadow-sm">
                        Ver más productos de la comunidad
                    </button>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection