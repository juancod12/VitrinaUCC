@extends('layouts.sellerPanel')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <a href="{{ route('user.seller.publications.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-indigo-600 mb-6 transition">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Cancelar Edición
    </a>

    <form action="{{ route('user.seller.publications.update', $publicacion->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-100 border border-gray-100 overflow-hidden">
            <div class="p-8">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Editar Publicación</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    {{-- Multimedia --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-700 tracking-wide uppercase">Multimedia Actual</label>
                        <div class="relative group aspect-square bg-gray-100 rounded-[2rem] overflow-hidden shadow-inner">
                            <input type="file" name="multimedia" id="multimedia" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewFile()">
                            
                            @if($publicacion->multimedia)
                                @if($publicacion->tipo_multimedia == 'imagen')
                                    <img src="{{ asset('storage/'.$publicacion->multimedia) }}" id="img-preview" class="w-full h-full object-cover">
                                    <video id="video-preview" class="hidden w-full h-full object-cover" controls></video>
                                @else
                                    <video src="{{ asset('storage/'.$publicacion->multimedia) }}" id="video-preview" class="w-full h-full object-cover" controls></video>
                                    <img id="img-preview" class="hidden w-full h-full object-cover">
                                @endif
                            @else
                                <div id="placeholder" class="flex items-center justify-center h-full">
                                    <p class="text-gray-400">Sin multimedia</p>
                                </div>
                            @endif
                            
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                <p class="text-white font-bold text-sm">Cambiar Archivo</p>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 text-center italic text-indigo-500 font-bold">Toca la imagen para subir una nueva</p>
                    </div>

                    {{-- Formulario --}}
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Título</label>
                            <input type="text" name="titulo" value="{{ $publicacion->titulo }}" class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-medium" required>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Sección</label>
                                <input type="text" name="seccion" value="{{ $publicacion->seccion }}" class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Estado</label>
                                <select name="estado" class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-indigo-600">
                                    <option value="activo" {{ $publicacion->estado == 'activo' ? 'selected' : '' }}>Publicado</option>
                                    <option value="borrador" {{ $publicacion->estado == 'borrador' ? 'selected' : '' }}>Borrador</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Contenido</label>
                            <textarea name="contenido" rows="6" class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500" required>{{ $publicacion->contenido }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-gray-50/50 border-t border-gray-100 flex justify-end">
                <button type="submit" class="w-full md:w-auto px-12 py-4 bg-indigo-600 text-white font-extrabold rounded-2xl hover:bg-indigo-700 shadow-xl shadow-indigo-100 transition active:scale-95">
                    Guardar Cambios
                </button>
            </div>
        </div>
    </form>
</div>

<script>
// El mismo script de preview que en create.blade.php
function previewFile() {
    const file = document.querySelector('#multimedia').files[0];
    const imgPreview = document.querySelector('#img-preview');
    const videoPreview = document.querySelector('#video-preview');
    const reader = new FileReader();

    reader.onloadend = function () {
        if (file.type.includes('video')) {
            videoPreview.src = reader.result;
            videoPreview.classList.remove('hidden');
            imgPreview.classList.add('hidden');
        } else {
            imgPreview.src = reader.result;
            imgPreview.classList.remove('hidden');
            videoPreview.classList.add('hidden');
        }
    }
    if (file) reader.readAsDataURL(file);
}
</script>
@endsection