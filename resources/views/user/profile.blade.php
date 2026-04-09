@extends('layouts.userPanel')

@section('content')
<div class="space-y-6" x-data="{ tab: 'info' }">

    {{-- Tabs --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex border-b border-gray-100">
            <button @click="tab = 'info'"
                :class="tab === 'info' ? 'border-b-2 border-sky-500 text-sky-600 bg-sky-50/50' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-4 text-sm font-bold transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Información Personal
            </button>
            <button @click="tab = 'password'"
                :class="tab === 'password' ? 'border-b-2 border-sky-500 text-sky-600 bg-sky-50/50' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-4 text-sm font-bold transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Cambiar Contraseña
            </button>
            <button @click="tab = 'delete'"
                :class="tab === 'delete' ? 'border-b-2 border-red-500 text-red-600 bg-red-50/50' : 'text-gray-500 hover:text-gray-700'"
                class="flex-1 py-4 text-sm font-bold transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Cuenta
            </button>
        </div>

        {{-- Tab: Información Personal --}}
        <div x-show="tab === 'info'" class="p-6 md:p-8">
            @if(session('status') === 'profile-updated')
                <div class="mb-4 px-4 py-3 bg-lime-50 border border-lime-200 rounded-xl text-lime-700 text-sm font-bold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    ¡Perfil actualizado correctamente!
                </div>
            @endif

            {{-- Avatar y nombre --}}
            <div class="flex items-center gap-5 mb-8 pb-6 border-b border-gray-100">
                <div class="relative group">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-sky-400 to-sky-600 flex items-center justify-center text-3xl font-black text-white shadow-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="absolute inset-0 bg-black/40 rounded-2xl opacity-0 group-hover:opacity-100 transition flex items-center justify-center cursor-pointer">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-black text-gray-900">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    <span class="inline-block mt-1 text-[10px] font-black px-2 py-0.5 rounded-full bg-sky-100 text-sky-700 uppercase tracking-wider">
                        {{ Auth::user()->rol ?? 'Usuario' }}
                    </span>
                </div>
            </div>

            <form method="POST" action="{{ route('user.buyer.profile.update') }}" class="space-y-5">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wider">Nombre completo</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 text-sm transition outline-none">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wider">Correo electrónico</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 text-sm transition outline-none">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wider">Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $perfil->telefono ?? '') }}"
                            placeholder="Ej: 300 123 4567"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 text-sm transition outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wider">Ciudad</label>
                        <input type="text" name="ciudad" value="{{ old('ciudad', $perfil->ciudad ?? '') }}"
                            placeholder="Ej: Bogotá"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 text-sm transition outline-none">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-bold px-6 py-3 rounded-xl text-sm shadow-md shadow-sky-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>

        {{-- Tab: Contraseña --}}
        <div x-show="tab === 'password'" x-cloak class="p-6 md:p-8">
            @if(session('status') === 'password-updated')
                <div class="mb-4 px-4 py-3 bg-lime-50 border border-lime-200 rounded-xl text-lime-700 text-sm font-bold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    ¡Contraseña actualizada!
                </div>
            @endif
            <h3 class="text-base font-black text-gray-800 mb-1">Cambiar contraseña</h3>
            <p class="text-sm text-gray-500 mb-6">Usa una contraseña segura de al menos 8 caracteres.</p>
            <form method="POST" action="{{ route('password.update') }}" class="space-y-5 max-w-md">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wider">Contraseña actual</label>
                    <input type="password" name="current_password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 text-sm transition outline-none">
                    @error('current_password', 'updatePassword')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wider">Nueva contraseña</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 text-sm transition outline-none">
                    @error('password', 'updatePassword')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1.5 uppercase tracking-wider">Confirmar nueva contraseña</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 text-sm transition outline-none">
                </div>
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-bold px-6 py-3 rounded-xl text-sm shadow-md shadow-sky-100 transition">
                    Actualizar Contraseña
                </button>
            </form>
        </div>

        {{-- Tab: Eliminar cuenta --}}
        <div x-show="tab === 'delete'" x-cloak class="p-6 md:p-8" x-data="{ confirmar: false }">
            <h3 class="text-base font-black text-gray-800 mb-1">Eliminar mi cuenta</h3>
            <p class="text-sm text-gray-500 mb-6">Esta acción es permanente. Todos tus datos serán eliminados y no se podrán recuperar.</p>
            <div class="bg-red-50 border border-red-200 rounded-2xl p-5">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <div>
                        <p class="text-sm font-bold text-red-700">¿Estás seguro de que quieres eliminar tu cuenta?</p>
                        <p class="text-xs text-red-600 mt-1">Se eliminarán tu historial de pedidos, direcciones y todos tus datos.</p>
                    </div>
                </div>
                <button @click="confirmar = true" x-show="!confirmar"
                    class="mt-4 bg-red-600 hover:bg-red-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition">
                    Eliminar mi cuenta
                </button>
                <div x-show="confirmar" class="mt-4">
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <label class="block text-xs font-bold text-red-700 mb-1.5">Ingresa tu contraseña para confirmar</label>
                        <input type="password" name="password" placeholder="Tu contraseña actual"
                            class="w-full px-4 py-3 rounded-xl border border-red-300 focus:border-red-500 focus:ring-2 focus:ring-red-100 text-sm transition outline-none mb-3">
                        <div class="flex gap-3">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition">Confirmar eliminación</button>
                            <button type="button" @click="confirmar = false" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-5 py-2.5 rounded-xl text-sm transition">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection