@extends('layouts.app')

@section('content')
<div class="bg-[#FDFDFC] min-h-screen">

    {{-- HERO --}}
    <div class="relative overflow-hidden py-24" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 40%, #0f3460 100%);">
        <div class="absolute inset-0 opacity-20">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1400" class="w-full h-full object-cover" alt="">
        </div>
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-5">
            <svg viewBox="0 0 400 400" class="w-full h-full"><circle cx="200" cy="200" r="180" fill="none" stroke="#84cc16" stroke-width="2"/><circle cx="200" cy="200" r="140" fill="none" stroke="#0097d9" stroke-width="1"/><circle cx="200" cy="200" r="100" fill="none" stroke="#84cc16" stroke-width="1.5"/></svg>
        </div>
        <div class="relative max-w-7xl mx-auto px-6 text-center">
            <span class="inline-block bg-[#84cc16]/20 text-[#d9f99d] text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full mb-6 border border-[#84cc16]/30">
                💡 Innovación universitaria en acción
            </span>
            <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 leading-tight">
                Proyectos que<br>
                <span class="text-[#84cc16]">transforman el mundo</span>
            </h1>
            <p class="text-gray-300 text-xl max-w-3xl mx-auto leading-relaxed mb-10">
                Descubre las iniciativas más innovadoras de nuestra comunidad emprendedora. Proyectos reales, personas reales, impacto real en Colombia.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#proyectos" class="bg-[#84cc16] hover:bg-[#74b614] text-white font-bold px-8 py-4 rounded-2xl shadow-xl transition-all hover:scale-105">
                    Explorar proyectos
                </a>
                <a href="{{ route('login') }}" class="bg-white/10 hover:bg-white/20 text-white font-bold px-8 py-4 rounded-2xl border border-white/20 transition-all">
                    Postular mi proyecto
                </a>
            </div>
        </div>
    </div>

    {{-- CATEGORÍAS FILTRO --}}
    <div class="bg-white border-b border-gray-100 sticky top-16 z-30">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex gap-2 overflow-x-auto py-4 scrollbar-hide">
                @foreach(['Todos', 'Tecnología', 'Gastronomía', 'Sostenibilidad', 'Moda', 'Salud', 'Arte & Cultura', 'Educación'] as $cat)
                <button class="flex-shrink-0 text-xs font-bold px-4 py-2 rounded-full transition
                    {{ $cat === 'Todos' ? 'bg-[#0097d9] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $cat }}
                </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- PROYECTO DESTACADO --}}
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="text-center mb-4">
            <span class="inline-block bg-[#84cc16]/10 text-[#4d7c0f] text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full">
                ⭐ Proyecto del mes
            </span>
        </div>
        <div class="bg-gradient-to-br from-[#0097d9] to-[#0369a1] rounded-3xl overflow-hidden shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="p-10 lg:p-14 flex flex-col justify-center">
                    <span class="inline-block bg-white/10 text-white text-xs font-bold px-3 py-1 rounded-full mb-6 w-fit border border-white/20">
                        🌿 Sostenibilidad
                    </span>
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-white mb-4 leading-tight">
                        EcoPackCo — Empaques 100% Biodegradables
                    </h2>
                    <p class="text-blue-100 leading-relaxed mb-6">
                        Una iniciativa pionera que fabrica empaques biodegradables a partir de fibra de caña de azúcar y almidón de yuca. En solo 8 meses han reemplazado más de 2 millones de empaques plásticos en el comercio local de Villavicencio.
                    </p>
                    <div class="flex flex-wrap gap-4 mb-8">
                        @foreach(['🌎 2M+ empaques', '👥 12 empleos directos', '📍 Meta, Colombia', '🏆 Premio UCC 2025'] as $dato)
                        <span class="bg-white/10 text-white text-xs font-semibold px-3 py-1.5 rounded-lg border border-white/10">{{ $dato }}</span>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-4">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=80&h=80&fit=crop" class="w-12 h-12 rounded-full border-2 border-white/30 object-cover" alt="Fundadora">
                        <div>
                            <p class="text-white font-bold text-sm">Laura Martínez</p>
                            <p class="text-blue-200 text-xs">Fundadora · Ing. Ambiental UCC</p>
                        </div>
                        <a href="#" class="ml-auto bg-white text-[#0097d9] font-black text-sm px-6 py-3 rounded-xl hover:bg-blue-50 transition">
                            Ver proyecto →
                        </a>
                    </div>
                </div>
                <div class="relative h-72 lg:h-auto overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=600" class="w-full h-full object-cover" alt="EcoPackCo">
                    <div class="absolute inset-0 bg-gradient-to-l from-transparent to-[#0097d9]/20 lg:hidden"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- GRID DE PROYECTOS --}}
    <div id="proyectos" class="max-w-7xl mx-auto px-6 pb-20">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900">Todos los proyectos</h2>
            <span class="text-sm text-gray-400 font-medium">Mostrando 6 de 48 proyectos</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                ['titulo' => 'TechCampus — Plataforma de Tutorías Universitarias', 'cat' => 'Tecnología', 'emoji' => '💻', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=400', 'desc' => 'App que conecta estudiantes con tutores académicos de forma inmediata. Más de 3.000 sesiones completadas en el primer semestre.', 'autor' => 'Carlos Pérez', 'carrera' => 'Ing. de Sistemas', 'tags' => ['App móvil', 'EdTech', 'Becas disponibles'], 'progreso' => 78, 'meta' => '$12M', 'color' => 'sky'],
                ['titulo' => 'Sabores de la Orinoquia — Gastronomía Ancestral', 'cat' => 'Gastronomía', 'emoji' => '🍲', 'img' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=400', 'desc' => 'Rescate de recetas ancestrales de los llanos colombianos transformadas en productos gourmet para exportación. Activos en 4 supermercados regionales.', 'autor' => 'Ana Rojas', 'carrera' => 'Gastronomía UCC', 'tags' => ['Exportación', 'Patrimonio cultural', 'INVIMA'], 'progreso' => 55, 'meta' => '$8M', 'color' => 'orange'],
                ['titulo' => 'SolarRural — Energía Solar para Zonas Apartadas', 'cat' => 'Sostenibilidad', 'emoji' => '☀️', 'img' => 'https://images.unsplash.com/photo-1509391366360-2e959784a276?q=80&w=400', 'desc' => 'Instalación de paneles solares asequibles en comunidades rurales de Meta y Vichada. 45 familias beneficiadas con energía limpia.', 'autor' => 'Miguel Torres', 'carrera' => 'Ing. Eléctrica', 'tags' => ['Energía limpia', 'Impacto social', 'Rural'], 'progreso' => 90, 'meta' => '$25M', 'color' => 'lime'],
                ['titulo' => 'MindaFit — Bienestar Mental para Universitarios', 'cat' => 'Salud', 'emoji' => '🧠', 'img' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=400', 'desc' => 'Plataforma de salud mental con meditación guiada, seguimiento de hábitos y acceso a psicólogos certificados a precios estudiantiles.', 'autor' => 'Valentina Cruz', 'carrera' => 'Psicología UCC', 'tags' => ['SaaS', 'Salud mental', 'Freemium'], 'progreso' => 40, 'meta' => '$5M', 'color' => 'violet'],
                ['titulo' => 'Tejido Digital — Moda Artesanal Colombiana', 'cat' => 'Moda', 'emoji' => '👗', 'img' => 'https://images.unsplash.com/photo-1558171813-1a8a7fd2f745?q=80&w=400', 'desc' => 'Marca de moda que fusiona diseño moderno con técnicas de tejido indígena. Colecciones limitadas que apoyan directamente a artesanas wayuu y zenú.', 'autor' => 'Isabella Moreno', 'carrera' => 'Diseño de Moda', 'tags' => ['Comercio justo', 'Artesanías', 'Exportación'], 'progreso' => 65, 'meta' => '$15M', 'color' => 'rose'],
                ['titulo' => 'AgroSmart — Agricultura de Precisión para Pequeños Productores', 'cat' => 'Tecnología', 'emoji' => '🌱', 'img' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?q=80&w=400', 'desc' => 'Sensores IoT de bajo costo para monitorear humedad, temperatura y nutrientes del suelo. Reduce el uso de agua en un 40% en cultivos piloto.', 'autor' => 'Sebastián Gómez', 'carrera' => 'Ing. Agroindustrial', 'tags' => ['IoT', 'AgriTech', 'Alianza FAO'], 'progreso' => 83, 'meta' => '$30M', 'color' => 'emerald'],
            ] as $p)
            @php
                $pc = [
                    'sky'     => ['tag' => 'bg-sky-100 text-sky-700',     'bar' => 'bg-sky-500',     'badge' => 'bg-sky-50 text-sky-700 border-sky-200'],
                    'orange'  => ['tag' => 'bg-orange-100 text-orange-700','bar' => 'bg-orange-500',  'badge' => 'bg-orange-50 text-orange-700 border-orange-200'],
                    'lime'    => ['tag' => 'bg-lime-100 text-lime-700',    'bar' => 'bg-lime-500',    'badge' => 'bg-lime-50 text-lime-700 border-lime-200'],
                    'violet'  => ['tag' => 'bg-violet-100 text-violet-700','bar' => 'bg-violet-500',  'badge' => 'bg-violet-50 text-violet-700 border-violet-200'],
                    'rose'    => ['tag' => 'bg-rose-100 text-rose-700',    'bar' => 'bg-rose-500',    'badge' => 'bg-rose-50 text-rose-700 border-rose-200'],
                    'emerald' => ['tag' => 'bg-emerald-100 text-emerald-700','bar'=>'bg-emerald-500', 'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
                ];
                $cc = $pc[$p['color']];
            @endphp
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 group flex flex-col">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $p['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700" alt="{{ $p['titulo'] }}">
                    <div class="absolute top-4 left-4">
                        <span class="text-xs font-bold {{ $cc['badge'] }} border px-3 py-1 rounded-full backdrop-blur-sm">
                            {{ $p['emoji'] }} {{ $p['cat'] }}
                        </span>
                    </div>
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-black px-3 py-1 rounded-full">
                        Meta: {{ $p['meta'] }}
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="font-extrabold text-gray-900 text-base leading-snug mb-2 group-hover:text-[#0097d9] transition">{{ $p['titulo'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 flex-grow">{{ $p['desc'] }}</p>

                    <div class="flex flex-wrap gap-1.5 mb-5">
                        @foreach($p['tags'] as $tag)
                        <span class="text-[10px] font-bold {{ $cc['tag'] }} px-2 py-1 rounded-full">{{ $tag }}</span>
                        @endforeach
                    </div>

                    {{-- Progreso --}}
                    <div class="mb-5">
                        <div class="flex justify-between text-xs font-bold text-gray-500 mb-1.5">
                            <span>Financiación</span>
                            <span>{{ $p['progreso'] }}%</span>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="{{ $cc['bar'] }} h-full rounded-full transition-all duration-1000" style="width: {{ $p['progreso'] }}%"></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                        <div>
                            <p class="text-xs font-bold text-gray-800">{{ $p['autor'] }}</p>
                            <p class="text-[10px] text-gray-400">{{ $p['carrera'] }}</p>
                        </div>
                        <a href="#" class="text-xs font-bold text-[#0097d9] hover:text-[#0284c7] transition flex items-center gap-1">
                            Ver proyecto →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <button class="bg-white border-2 border-gray-100 text-gray-600 font-bold px-10 py-4 rounded-2xl hover:border-[#0097d9] hover:text-[#0097d9] transition-all shadow-sm">
                Ver todos los proyectos (48)
            </button>
        </div>
    </div>

    {{-- POSTULA TU PROYECTO --}}
    <div class="bg-gradient-to-br from-[#1a1a2e] to-[#0f3460] py-20 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <div class="text-6xl mb-6">🚀</div>
            <h2 class="text-4xl font-extrabold text-white mb-4">¿Tienes un proyecto innovador?</h2>
            <p class="text-gray-300 text-lg mb-10 max-w-2xl mx-auto">
                Postula tu iniciativa y accede a financiación, mentoría especializada y visibilidad ante más de 10.000 usuarios de la plataforma.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                @foreach([
                    ['ico' => '💰', 'titulo' => 'Financiación', 'desc' => 'Accede a fondos de hasta $30M COP para hacer crecer tu idea.'],
                    ['ico' => '🎓', 'titulo' => 'Mentoría', 'desc' => 'Expertos de la industria guiarán cada etapa de tu proyecto.'],
                    ['ico' => '📢', 'titulo' => 'Visibilidad', 'desc' => 'Tu proyecto frente a clientes, inversionistas y aliados estratégicos.'],
                ] as $b)
                <div class="bg-white/10 rounded-2xl p-6 border border-white/10 text-left">
                    <div class="text-3xl mb-3">{{ $b['ico'] }}</div>
                    <h3 class="font-bold text-white mb-1">{{ $b['titulo'] }}</h3>
                    <p class="text-gray-400 text-sm">{{ $b['desc'] }}</p>
                </div>
                @endforeach
            </div>
            <a href="{{ route('login') }}" class="inline-block bg-[#84cc16] hover:bg-[#74b614] text-white font-black px-10 py-4 rounded-2xl shadow-xl transition-all hover:scale-105 text-lg">
                Postular mi proyecto →
            </a>
        </div>
    </div>

</div>
@endsection