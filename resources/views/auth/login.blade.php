<x-guest-layout>
    <style>
        /* Contenedor principal de la animación - PERSPECTIVA */
        .flip-card {
            background-color: transparent;
            perspective: 1500px; 
        }

        /* El panel que realmente gira */
        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
        }

        /* Clase que activa el giro mediante JS */
        .flipped {
            transform: rotateY(180deg);
        }

        /* Caras de la tarjeta */
        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 1.25rem; /* rounded-2xl */
            
            /* --- CORRECCIÓN: BORDE VISIBLE Y FONDO BLANCO --- */
            border: 1px solid #e5e7eb; /* border-gray-200 */
            background-color: #ffffff; /* bg-white - Esto hace que resalte */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-lg */
        }

        /* Posición inicial de la cara trasera */
        .flip-card-back {
            transform: rotateY(180deg);
        }
    </style>

    <div class="flex flex-col items-center justify-center min-h-screen py-8 px-4 bg-gray-100">
        
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-black text-sky-600 tracking-tight">Vitrina <span class="text-lime-600 ">UCC</span></h1>
            <p class="text-gray-600 mt-2 text-base">Ingresa para conectar con tu comunidad</p>
        </div>

        <div class="flip-card w-full max-w-md h-[560px]">
            <div id="cardInner" class="flip-card-inner">
                
                <div class="flip-card-front p-8 flex flex-col justify-center">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">Iniciar Sesión</h2>
                        <p class="text-gray-500 text-sm mt-1">Ingresa tus credenciales para continuar</p>
                    </div>

                    <x-auth-session-status class="mb-3" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="text-left space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="email" value="Correo Institucional" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="password" value="Contraseña" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <div class="flex items-center justify-between mt-1">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-sky-600 shadow-sm focus:ring-sky-500 w-4 h-4" name="remember">
                                <span class="ms-2 text-xs text-gray-700">Recuérdame</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a class="text-xs text-sky-600 hover:underline font-medium" href="{{ route('password.request') }}">¿Olvidaste tu clave?</a>
                            @endif
                        </div>

                        <x-primary-button class="w-full bg-sky-600 hover:bg-sky-700 justify-center py-3.5 text-sm">
                            Entrar a mi Cuenta
                        </x-primary-button>
                    </form>

                    <div class="mt-8 pt-5 border-t border-gray-100 text-center">
                        <p class="text-gray-600 text-xs">¿Eres nuevo en la comunidad?</p>
                        <button onclick="flipCard()" class="text-lime-700 font-black uppercase tracking-widest text-[10px] mt-2.5 hover:text-lime-800 transition-colors cursor-pointer">
                            Crear Cuenta Nueva
                        </button>
                    </div>
                </div>

                <div class="flip-card-back p-8 flex flex-col justify-center">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Crear Cuenta</h2>
                        <p class="text-gray-500 text-sm mt-1">Únete a la red comercial universitaria</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="text-left space-y-3.5">
                        @csrf
                        
                        <div>
                            <x-input-label for="name" value="Nombre Completo" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="rol" value="¿Qué serás en la Vitrina?" />
                            <select id="rol" name="rol" class="block mt-1 w-full border-gray-300 focus:border-lime-500 focus:ring-lime-500 rounded-lg text-gray-700 text-sm h-[40px] shadow-sm px-4">
                                <option value="comprador">Comprador (Quiero comprar)</option>
                                <option value="emprendedor">Emprendedor (Quiero vender)</option>
                            </select>
                            <x-input-error :messages="$errors->get('rol')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="reg_email" value="Correo" />
                            <x-text-input id="reg_email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <div class="grid grid-cols-2 gap-3.5">
                            <div>
                                <x-input-label for="reg_password" value="Clave" />
                                <x-text-input id="reg_password" class="block mt-1 w-full" type="password" name="password" required />
                            </div>
                            <div>
                                <x-input-label for="password_confirmation" value="Confirmar" />
                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                            </div>
                        </div>

                        <x-primary-button class="w-full bg-lime-600 hover:bg-lime-700 justify-center py-3.5 text-sm mt-4">
                            Registrarme Ahora
                        </x-primary-button>
                    </form>

                    <div class="mt-7 text-center">
                        <button type="button" onclick="flipCard()" class="text-sky-700 font-bold text-xs hover:underline flex items-center justify-center mx-auto cursor-pointer">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                            Volver al ingreso
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function flipCard() {
            document.getElementById('cardInner').classList.toggle('flipped');
        }
    </script>
</x-guest-layout>