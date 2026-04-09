@extends('layouts.app')

@section('content')
<div class="bg-[#FDFDFC] min-h-screen">

    {{-- HERO --}}
    <div class="relative bg-gradient-to-br from-[#0097d9] via-[#0284c7] to-[#0369a1] overflow-hidden py-24">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=1400" class="w-full h-full object-cover" alt="">
        </div>
        {{-- Círculos decorativos --}}
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-[#84cc16]/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 text-center">
            <span class="inline-block bg-white/10 text-white text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full mb-6 border border-white/20">
                🚀 Todo lo que necesitas para crecer
            </span>
            <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 leading-tight">
                Servicios que impulsan<br>
                <span class="text-[#d9f99d]">tu emprendimiento</span>
            </h1>
            <p class="text-blue-100 text-xl max-w-3xl mx-auto leading-relaxed mb-10">
                En Vitrina UCC conectamos a los emprendedores de la comunidad con las herramientas, mentorías y recursos que necesitan para escalar sus negocios.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('login') }}" class="bg-[#84cc16] hover:bg-[#74b614] text-white font-bold px-8 py-4 rounded-2xl shadow-xl shadow-[#84cc16]/30 transition-all hover:scale-105">
                    Comenzar ahora
                </a>
                <a href="#servicios" class="bg-white/10 hover:bg-white/20 text-white font-bold px-8 py-4 rounded-2xl border border-white/30 transition-all backdrop-blur-sm">
                    Ver servicios ↓
                </a>
            </div>
        </div>
    </div>

    {{-- STATS --}}
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                @foreach([
                    ['número' => '+500', 'label' => 'Emprendedores activos', 'icon' => '🧑‍💼'],
                    ['número' => '+1.200', 'label' => 'Productos publicados', 'icon' => '📦'],
                    ['número' => '98%', 'label' => 'Satisfacción de usuarios', 'icon' => '⭐'],
                    ['número' => '12', 'label' => 'Ciudades con presencia', 'icon' => '🏙️'],
                ] as $stat)
                <div>
                    <div class="text-3xl mb-1">{{ $stat['icon'] }}</div>
                    <div class="text-3xl font-black text-[#0097d9]">{{ $stat['número'] }}</div>
                    <div class="text-sm text-gray-500 font-medium">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- SERVICIOS PRINCIPALES --}}
    <div id="servicios" class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Nuestros Servicios</h2>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">Diseñados especialmente para emprendedores universitarios que quieren llevar sus ideas al siguiente nivel.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                [
                    'icon' => '🏪',
                    'color' => 'sky',
                    'titulo' => 'Vitrina Digital',
                    'desc' => 'Crea tu tienda virtual en minutos. Publica tus productos, gestiona tu inventario y recibe pedidos directamente desde la plataforma sin comisiones ocultas.',
                    'tags' => ['Sin comisiones', 'Fácil de usar', 'Personalizable'],
                    'cta' => 'Abrir mi tienda',
                ],
                [
                    'icon' => '🎓',
                    'color' => 'lime',
                    'titulo' => 'Mentoría Empresarial',
                    'desc' => 'Accede a sesiones personalizadas con expertos en marketing, finanzas y estrategia empresarial. Más de 30 mentores certificados de la comunidad UCC.',
                    'tags' => ['+30 mentores', 'Online y presencial', 'Certificado'],
                    'cta' => 'Agendar sesión',
                ],
                [
                    'icon' => '📊',
                    'color' => 'violet',
                    'titulo' => 'Panel de Analíticas',
                    'desc' => 'Conoce el comportamiento de tus compradores, los productos más vistos y tus métricas de ventas en tiempo real con dashboards intuitivos.',
                    'tags' => ['Tiempo real', 'Exportable', 'IA integrada'],
                    'cta' => 'Ver demo',
                ],
                [
                    'icon' => '📸',
                    'color' => 'orange',
                    'titulo' => 'Sesiones Fotográficas',
                    'desc' => 'Te conectamos con fotógrafos especializados en product photography a precios accesibles para la comunidad. Porque una buena foto vende más.',
                    'tags' => ['Precio especial UCC', 'Estudio o a domicilio', 'Edición incluida'],
                    'cta' => 'Reservar sesión',
                ],
                [
                    'icon' => '💳',
                    'color' => 'emerald',
                    'titulo' => 'Pagos Seguros',
                    'desc' => 'Integración con PSE, tarjetas crédito/débito y pago contra entrega. Tu dinero protegido y tus clientes tranquilos en cada transacción.',
                    'tags' => ['PSE', 'Tarjetas', 'Contra entrega'],
                    'cta' => 'Saber más',
                ],
                [
                    'icon' => '📦',
                    'color' => 'rose',
                    'titulo' => 'Logística y Envíos',
                    'desc' => 'Alianzas con operadores logísticos para que tus productos lleguen a todo Colombia. Tarifas preferenciales para miembros activos de la plataforma.',
                    'tags' => ['Todo Colombia', 'Rastreo en vivo', 'Tarifas preferenciales'],
                    'cta' => 'Calcular tarifa',
                ],
            ] as $s)
            @php
                $colors = [
                    'sky'     => ['bg' => 'bg-sky-50',     'icon' => 'bg-sky-100 text-sky-600',     'tag' => 'bg-sky-100 text-sky-700',     'btn' => 'bg-sky-500 hover:bg-sky-600'],
                    'lime'    => ['bg' => 'bg-lime-50',    'icon' => 'bg-lime-100 text-lime-700',   'tag' => 'bg-lime-100 text-lime-700',   'btn' => 'bg-lime-500 hover:bg-lime-600'],
                    'violet'  => ['bg' => 'bg-violet-50',  'icon' => 'bg-violet-100 text-violet-600','tag' => 'bg-violet-100 text-violet-700','btn' => 'bg-violet-500 hover:bg-violet-600'],
                    'orange'  => ['bg' => 'bg-orange-50',  'icon' => 'bg-orange-100 text-orange-600','tag' => 'bg-orange-100 text-orange-700','btn' => 'bg-orange-500 hover:bg-orange-600'],
                    'emerald' => ['bg' => 'bg-emerald-50', 'icon' => 'bg-emerald-100 text-emerald-600','tag' => 'bg-emerald-100 text-emerald-700','btn' => 'bg-emerald-500 hover:bg-emerald-600'],
                    'rose'    => ['bg' => 'bg-rose-50',    'icon' => 'bg-rose-100 text-rose-600',   'tag' => 'bg-rose-100 text-rose-700',   'btn' => 'bg-rose-500 hover:bg-rose-600'],
                ];
                $c = $colors[$s['color']];
            @endphp
            <div class="bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 flex flex-col overflow-hidden group">
                <div class="{{ $c['bg'] }} p-8 transition-all duration-300">
                    <div class="w-16 h-16 {{ $c['icon'] }} rounded-2xl flex items-center justify-center text-3xl mb-5 group-hover:scale-110 transition-transform duration-300">
                        {{ $s['icon'] }}
                    </div>
                    <h3 class="text-xl font-extrabold text-gray-900 mb-3">{{ $s['titulo'] }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $s['desc'] }}</p>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($s['tags'] as $tag)
                            <span class="text-xs font-bold {{ $c['tag'] }} px-3 py-1 rounded-full">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('login') }}" class="block w-full text-center text-white text-sm font-bold {{ $c['btn'] }} py-3 rounded-xl transition-all shadow-sm">
                            {{ $s['cta'] }} →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- PROCESO / CÓMO FUNCIONA --}}
    <div class="bg-gradient-to-br from-gray-50 to-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">¿Cómo funciona?</h2>
                <p class="text-gray-500 text-lg">En 4 pasos sencillos tu emprendimiento estará en línea</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach([
                    ['paso' => '01', 'titulo' => 'Regístrate', 'desc' => 'Crea tu cuenta como emprendedor UCC en menos de 2 minutos con tu correo institucional.', 'icon' => '📝'],
                    ['paso' => '02', 'titulo' => 'Configura tu vitrina', 'desc' => 'Sube tu logo, describe tu negocio y personaliza tu perfil público para atraer compradores.', 'icon' => '🎨'],
                    ['paso' => '03', 'titulo' => 'Publica productos', 'desc' => 'Agrega tus productos con fotos, precios y descripción. Tu catálogo estará visible de inmediato.', 'icon' => '🛍️'],
                    ['paso' => '04', 'titulo' => 'Vende y crece', 'desc' => 'Recibe pedidos, gestiona tus ventas y usa nuestras herramientas para escalar tu negocio.', 'icon' => '📈'],
                ] as $i => $paso)
                <div class="relative bg-white rounded-3xl p-8 shadow-sm border border-gray-100 text-center">
                    @if($i < 3)
                    <div class="hidden md:block absolute top-1/2 -right-3 w-6 h-0.5 bg-[#0097d9] z-10"></div>
                    @endif
                    <div class="w-12 h-12 bg-[#0097d9] text-white rounded-2xl flex items-center justify-center font-black text-lg mx-auto mb-4">
                        {{ $paso['paso'] }}
                    </div>
                    <div class="text-3xl mb-3">{{ $paso['icon'] }}</div>
                    <h3 class="font-extrabold text-gray-900 mb-2">{{ $paso['titulo'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $paso['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- PLANES / PRECIOS --}}
    <div class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Planes para todos</h2>
            <p class="text-gray-500 text-lg">Empieza gratis y escala según tus necesidades</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            @foreach([
                ['plan' => 'Básico', 'precio' => 'Gratis', 'sub' => 'Para siempre', 'color' => 'border-gray-200', 'badge' => '', 'features' => ['1 vitrina digital', 'Hasta 10 productos', 'Soporte por email', 'Analíticas básicas'], 'btn' => 'bg-gray-900 hover:bg-gray-700', 'popular' => false],
                ['plan' => 'Emprendedor', 'precio' => '$29.900', 'sub' => 'por mes', 'color' => 'border-[#0097d9] ring-2 ring-[#0097d9]', 'badge' => '⭐ Más popular', 'features' => ['Vitrina personalizada', 'Productos ilimitados', 'Soporte prioritario', 'Analíticas avanzadas', 'Sesión de mentoría mensual', 'Destacado en búsquedas'], 'btn' => 'bg-[#0097d9] hover:bg-[#0284c7]', 'popular' => true],
                ['plan' => 'Pro UCC', 'precio' => '$59.900', 'sub' => 'por mes', 'color' => 'border-[#84cc16] ring-2 ring-[#84cc16]', 'badge' => '🚀 Máximo potencial', 'features' => ['Todo del plan Emprendedor', 'API para integración', '4 mentorías al mes', 'Sesión fotográfica incluida', 'Tarifas de envío especiales', 'Gestor de cuenta dedicado'], 'btn' => 'bg-[#84cc16] hover:bg-[#74b614]', 'popular' => false],
            ] as $plan)
            <div class="bg-white rounded-3xl p-8 border-2 {{ $plan['color'] }} relative flex flex-col">
                @if($plan['badge'])
                    <span class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#0097d9] text-white text-xs font-black px-4 py-1.5 rounded-full whitespace-nowrap">
                        {{ $plan['badge'] }}
                    </span>
                @endif
                <div class="mb-6">
                    <h3 class="text-xl font-extrabold text-gray-900 mb-2">{{ $plan['plan'] }}</h3>
                    <div class="flex items-end gap-1">
                        <span class="text-4xl font-black text-gray-900">{{ $plan['precio'] }}</span>
                        <span class="text-gray-400 text-sm mb-1">{{ $plan['sub'] }}</span>
                    </div>
                </div>
                <ul class="space-y-3 mb-8 flex-grow">
                    @foreach($plan['features'] as $f)
                    <li class="flex items-center gap-3 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-[#84cc16] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('login') }}" class="block text-center text-white font-bold {{ $plan['btn'] }} py-3 rounded-xl transition-all">
                    Elegir este plan
                </a>
            </div>
            @endforeach
        </div>
    </div>

    {{-- CTA FINAL --}}
    <div class="bg-gradient-to-r from-[#0097d9] to-[#0369a1] py-20 px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-4xl font-extrabold text-white mb-4">¿Listo para dar el salto?</h2>
            <p class="text-blue-100 text-lg mb-8">Únete a más de 500 emprendedores que ya están vendiendo en Vitrina UCC.</p>
            <a href="{{ route('register') }}" class="inline-block bg-[#84cc16] hover:bg-[#74b614] text-white font-black px-10 py-4 rounded-2xl shadow-xl shadow-[#84cc16]/30 transition-all hover:scale-105 text-lg">
                Crear mi cuenta gratis →
            </a>
        </div>
    </div>

</div>
@endsection