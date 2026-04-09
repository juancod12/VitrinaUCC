@extends('layouts.sellerPanel')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="bg-white shadow-lg rounded-2xl p-8 max-w-md w-full text-center border border-gray-200">
            
            <h2 class="text-2xl font-bold text-gray-800 mb-3">
                Aún no tienes perfil de emprendedor
            </h2>

            <p class="text-gray-600 text-sm mb-6">
                Para publicar productos o contenido, primero debes crear tu perfil de emprendedor.
            </p>

            <a href="{{ route('user.seller.business.index') }}"
                class="inline-block bg-lime-600 hover:bg-lime-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                Crear mi perfil ahora
            </a>

            <div class="mt-4">
                <a href="{{ route('user.seller.sellerPanel') }}"
                    class="text-sm text-gray-500 hover:underline">
                    Volver al panel
                </a>
            </div>
        </div>
    </div>
@endsection