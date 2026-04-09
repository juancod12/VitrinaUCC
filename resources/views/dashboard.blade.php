@extends('layouts.app')

@section('content')
<div class="bg-[#F8FAFC] min-h-screen pb-24">
    {{-- Encabezado --}}
    <div class="bg-white border-b border-gray-100 pt-10 pb-8 mb-6 shadow-sm">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">
                Muro <span class="text-[#0097d9]">UCC</span>
            </h1>
            <p class="text-gray-500 mt-2 text-sm md:text-base">Historias y talento emprendedor.</p>
            
            <form action="{{ route('dashboard') }}" method="GET" class="max-w-xl mx-auto mt-6 relative px-4">
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="w-full bg-gray-50 border-none rounded-2xl py-4 pl-12 pr-4 focus:ring-2 focus:ring-[#0097d9] shadow-inner transition-all"
                    placeholder="Buscar emprendimientos...">
                <div class="absolute left-8 top-4 text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </form>
        </div>
    </div>

    {{-- Feed de Publicaciones --}}
    <div class="max-w-2xl mx-auto px-2 md:px-0 space-y-8">
        @forelse($publicaciones as $pub)
        {{-- Inicializamos Alpine.js: open será true si venimos de comentar esta publicación específica --}}
        <article x-data="{ open: {{ session('open_id') == $pub->id ? 'true' : 'false' }} }" class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            
            {{-- Header Usuario --}}
            <div class="p-5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('storage/' . $pub->emprendedor->logo) }}" 
                         class="w-12 h-12 rounded-2xl object-cover ring-2 ring-gray-50 shadow-sm" alt="Logo">
                    <div>
                        <h3 class="font-bold text-gray-900 leading-none text-base">{{ $pub->emprendedor->nombre_negocio }}</h3>
                        <span class="text-[11px] text-[#0097d9] font-bold uppercase tracking-wider">{{ $pub->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <span class="bg-blue-50 text-[#0097d9] text-[10px] font-black px-3 py-1.5 rounded-full uppercase">
                    {{ $pub->seccion ?? 'Novedad' }}
                </span>
            </div>

            {{-- Multimedia --}}
            @if($pub->multimedia)
            <div class="relative w-full aspect-square md:aspect-video overflow-hidden bg-gray-100">
                @if($pub->tipo_multimedia === 'imagen')
                    <img src="{{ asset('storage/' . $pub->multimedia) }}" class="w-full h-full object-cover" alt="Contenido">
                @else
                    <video controls class="w-full h-full object-cover">
                        <source src="{{ asset('storage/' . $pub->multimedia) }}" type="video/mp4">
                    </video>
                @endif
            </div>
            @endif

            {{-- Texto de la publicación --}}
            <div class="p-6">
                <h2 class="text-xl font-extrabold text-gray-900 mb-2 leading-tight">{{ $pub->titulo }}</h2>
                <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-6">{{ $pub->contenido }}</p>

                <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                    <div class="flex items-center gap-4">
                        {{-- Botón Me Encanta --}}
                        <button onclick="likePublicacion({{ $pub->id }}, this)" 
                            class="flex items-center gap-2 group transition {{ $pub->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-gray-400' }}">
                            <div class="p-2.5 rounded-full group-hover:bg-red-50 transition-all">
                                <svg class="w-6 h-6 {{ $pub->isLikedBy(auth()->user()) ? 'fill-current' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </div>
                            <span class="font-bold text-sm like-count">{{ $pub->me_encantas_count }}</span>
                        </button>

                        {{-- Botón Desplegar Comentarios --}}
                        <button @click="open = !open" 
                            class="flex items-center gap-2 group text-gray-400 hover:text-[#0097d9] transition-all">
                            <div class="p-2.5 rounded-full group-hover:bg-blue-50">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <span class="font-bold text-sm">{{ $pub->comentarios_count }}</span>
                        </button>
                    </div>
                    
                    <a href="{{ $pub->emprendedor->sitio_web ?? '#' }}" target="_blank" class="text-[#0097d9] font-black text-sm hover:underline">Ver Perfil +</a>
                </div>
            </div>

            {{-- SECCIÓN DESPLEGABLE DE COMENTARIOS --}}
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 id="comentarios-{{ $pub->id }}" 
                 class="bg-gray-50/50 p-6 border-t border-gray-50 scroll-mt-20">
                
                <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Comentarios</h4>
                
                <div class="space-y-4 mb-6 overflow-y-auto max-h-64 custom-scrollbar">
                    @forelse($pub->comentarios as $comentario)
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#0097d9] text-white flex items-center justify-center text-[10px] font-bold flex-shrink-0">
                            {{ substr($comentario->user->name, 0, 1) }}
                        </div>
                        <div class="bg-white p-3 rounded-2xl shadow-sm border border-gray-100 flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-xs text-gray-800">{{ $comentario->user->name }}</span>
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-2.5 h-2.5 {{ $i <= $comentario->estrellas ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 leading-snug">{{ $comentario->contenido }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-gray-400 italic text-center py-4">Aún no hay comentarios. ¡Sé el primero!</p>
                    @endforelse
                </div>

                {{-- Formulario --}}
                <form action="{{ route('publicaciones.comentar', $pub->id) . '#comentarios-' . $pub->id }}" method="POST" class="space-y-3">
                    @csrf
                    <div class="flex items-center gap-2 px-1">
                        <div class="flex flex-row-reverse gap-1">
                            @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}-{{ $pub->id }}" name="estrellas" value="{{ $i }}" class="hidden peer" required>
                            <label for="star{{ $i }}-{{ $pub->id }}" class="cursor-pointer text-gray-200 peer-hover:text-yellow-400 peer-checked:text-yellow-400 transition-colors">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </label>
                            @endfor
                        </div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase">Calificar</span>
                    </div>

                    <div class="flex gap-2">
                        <input type="text" name="contenido" placeholder="Escribe un comentario..." 
                            class="flex-1 bg-white border-gray-100 focus:ring-2 focus:ring-[#0097d9] rounded-2xl text-xs py-3 px-4 shadow-sm" required>
                        <button type="submit" class="bg-[#0097d9] text-white px-5 rounded-2xl hover:bg-[#007bb1] transition-all flex items-center justify-center">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </article>
        @empty
        <div class="text-center py-20 bg-white rounded-[2rem] border-2 border-dashed border-gray-100 mx-4">
            <p class="text-gray-400 font-medium italic">Aún no hay historias compartidas.</p>
        </div>
        @endforelse

        <div class="py-10">
            {{ $publicaciones->links() }}
        </div>
    </div>
</div>

<style>
    html {
        scroll-behavior: smooth;
    }
    
    .scroll-mt-20 {
        scroll-margin-top: 5rem;
    }

    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
</style>

{{-- Asegúrate de tener Alpine.js en tu layout o inclúyelo aquí --}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
function likePublicacion(id, btn) {
    btn.disabled = true;
    fetch(`/publicaciones/${id}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(r => r.json())
    .then(data => {
        const label = btn.querySelector('.like-count');
        const svg = btn.querySelector('svg');
        label.innerText = data.count;
        if (data.status === 'added') {
            btn.classList.replace('text-gray-400', 'text-red-500');
            svg.classList.add('fill-current');
        } else {
            btn.classList.replace('text-red-500', 'text-gray-400');
            svg.classList.remove('fill-current');
        }
    }).finally(() => btn.disabled = false);
}
</script>
@endsection