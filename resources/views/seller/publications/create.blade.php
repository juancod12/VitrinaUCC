@extends('layouts.sellerPanel')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    {{-- Botón Volver --}}
    <a href="{{ route('user.seller.publications.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-indigo-600 mb-6 transition">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Volver al Muro
    </a>

    <form action="{{ route('user.seller.publications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-100 border border-gray-100 overflow-hidden">
            <div class="p-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900">Nueva Publicación</h2>
                    <span class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    </span>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    {{-- Zona Multimedia --}}
                    <div class="space-y-4">
                        <label class="block text-sm font-bold text-gray-700 tracking-wide uppercase">Multimedia</label>
                        <div id="drop-area" class="relative group aspect-square bg-gray-50 border-2 border-dashed border-gray-200 rounded-[2rem] flex items-center justify-center overflow-hidden transition hover:border-indigo-400">
                            <input type="file" name="multimedia" id="multimedia" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewFile()" accept="image/*,video/*">
                            
                            <div id="placeholder" class="text-center p-6 transition group-hover:scale-110">
                                <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                                </div>
                                <p class="text-sm font-bold text-gray-900">Subir imagen o video</p>
                                <p class="text-xs text-gray-400 mt-1">Arrastra o haz clic aquí</p>
                            </div>

                            <img id="img-preview" class="hidden w-full h-full object-cover">
                            <video id="video-preview" class="hidden w-full h-full object-cover" controls></video>
                        </div>
                    </div>

                    {{-- Datos de la Publicación --}}
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Título de la publicación</label>
                            <input type="text" name="titulo" class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition font-medium" placeholder="Escribe un título llamativo..." required>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Sección</label>
                                <input type="text" name="seccion" class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500" placeholder="Ej: Ofertas">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Estado</label>
                                <select name="estado" class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-indigo-600">
                                    <option value="activo">Publicar</option>
                                    <option value="borrador">Borrador</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Contenido / Descripción</label>
                            <textarea name="contenido" rows="6" class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500" placeholder="Comparte los detalles de tu publicación con tus seguidores..." required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-gray-50/50 border-t border-gray-100 flex justify-end items-center gap-4">
                <button type="submit" class="w-full md:w-auto px-12 py-4 bg-indigo-600 text-white font-extrabold rounded-2xl hover:bg-indigo-700 shadow-xl shadow-indigo-200 transition active:scale-95">
                    Compartir ahora
                </button>
            </div>
        </div>
    </form>
</div>

<script>
function previewFile() {
    const file = document.querySelector('#multimedia').files[0];
    const imgPreview = document.querySelector('#img-preview');
    const videoPreview = document.querySelector('#video-preview');
    const placeholder = document.querySelector('#placeholder');
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
        placeholder.classList.add('hidden');
    }

    if (file) reader.readAsDataURL(file);
}
</script>
@endsection