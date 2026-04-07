<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white shadow-lg border-b border-gray-100 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-2xl font-bold tracking-tight">
                        <span class="text-sky-500">Vitrina</span><span class="text-lime-500">  UCC</span>
                    </span>
                </div>
                
                <div class="hidden md:ml-10 md:flex md:space-x-8">
                    <a href="/" 
                       class="{{ request()->is('/') ? 'border-lime-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-sky-600 hover:border-sky-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150">
                        Inicio
                    </a>

                    <a href="{{ route('public.products.index') }}" 
                       class="{{ request()->routeIs('public.products.index') ? 'border-lime-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-sky-600 hover:border-sky-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150">
                        Productos
                    </a>

                    <a href="#" 
                       class="{{ request()->routeIs('servicios.*') ? 'border-lime-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-sky-600 hover:border-sky-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150">
                        Servicios
                    </a>

                    <a href="#" 
                       class="{{ request()->routeIs('proyectos.*') ? 'border-lime-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-sky-600 hover:border-sky-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150">
                        Proyectos
                    </a>
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <button class="bg-white text-sky-600 px-4 py-2 rounded-lg border border-sky-500 font-semibold hover:bg-sky-50 transition">
                    Aliados
                </button>
                <button class="bg-lime-500 text-white px-5 py-2 rounded-lg font-semibold hover:bg-green-500 shadow-md shadow-lime-100 transition">
                    Acceso Comunidad
                </button>
            </div>

            <div class="flex items-center md:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-sky-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="md:hidden bg-white border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            <a href="/" class="{{ request()->is('/') ? 'bg-lime-50 border-lime-500 text-lime-700' : 'border-transparent text-gray-600 hover:bg-sky-50 hover:border-sky-500 hover:text-sky-700' }} block pl-3 pr-4 py-3 border-l-4 text-base font-medium">Inicio</a>
            
            <a href="{{ route('public.products.index') }}" class="{{ request()->routeIs('public.products.index') ? 'bg-lime-50 border-lime-500 text-lime-700' : 'border-transparent text-gray-600 hover:bg-sky-50 hover:border-sky-500 hover:text-sky-700' }} block pl-3 pr-4 py-3 border-l-4 text-base font-medium">Productos</a>
            
            <a href="#" class="{{ request()->routeIs('servicios.*') ? 'bg-lime-50 border-lime-500 text-lime-700' : 'border-transparent text-gray-600 hover:bg-sky-50 hover:border-sky-500 hover:text-sky-700' }} block pl-3 pr-4 py-3 border-l-4 text-base font-medium">Servicios</a>
            
            <a href="#" class="{{ request()->routeIs('proyectos.*') ? 'bg-lime-50 border-lime-500 text-lime-700' : 'border-transparent text-gray-600 hover:bg-sky-50 hover:border-sky-500 hover:text-sky-700' }} block pl-3 pr-4 py-3 border-l-4 text-base font-medium">Proyectos</a>
        </div>
        <div class="pt-4 pb-4 border-t border-gray-200 px-4 space-y-2">
            <button class="w-full bg-sky-500 text-white py-2 rounded-md font-medium">Aliados y Ciudadanía</button>
        </div>
    </div>
</nav>