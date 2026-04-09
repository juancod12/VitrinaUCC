@extends('layouts.app')

@section('content')
<div class="bg-[#FDFDFC] min-h-screen">

    {{-- HERO --}}
    <div class="relative overflow-hidden py-20" style="background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1400" class="w-full h-full object-cover" alt="">
        </div>
        {{-- Elementos decorativos --}}
        <div class="absolute top-10 left-10 w-32 h-32 bg-[#84cc16]/10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-10 right-10 w-48 h-48 bg-[#0097d9]/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-3 bg-white/10 border border-white/20 px-5 py-2.5 rounded-full mb-8 backdrop-blur-sm">
                <div class="flex -space-x-2">
                    @foreach(['photo-1494790108377-be9c29b29330','photo-1507003211169-0a1dd7228f2d','photo-1500648767791-00dcc994a43e'] as $u)
                    <img src="https://images.unsplash.com/{{ $u }}?q=80&w=32&h=32&fit=crop" class="w-7 h-7 rounded-full border-2 border-white/30 object-cover" alt="">
                    @endforeach
                </div>
                <span class="text-white text-xs font-bold">+500 miembros activos esta semana</span>
            </div>

            <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 leading-tight">
                Bienvenido a la<br>
                <span class="text-[#84cc16]">Comunidad UCC</span>
            </h1>
            <p class="text-gray-300 text-xl max-w-3xl mx-auto leading-relaxed mb-4">
                Un espacio exclusivo donde emprendedores, compradores y aliados de la Universidad Cooperativa de Colombia se conectan, colaboran y crecen juntos.
            </p>
        </div>
    </div>

    {{-- TARJETAS DE ACCESO --}}
    <div class="max-w-6xl mx-auto px-6 -mt-8 pb-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Comprador --}}
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 group">
                <div class="w-16 h-16 bg-sky-100 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                    🛍️
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-3">Soy Comprador</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">
                    Descubre y apoya el talento emprendedor de la comunidad UCC. Productos únicos, artesanales y con historia detrás de cada uno.
                </p>
                <ul class="space-y-2 mb-8">
                    @foreach(['Acceso a +1.200 productos', 'Favoritos y lista de deseos', 'Historial de pedidos', 'Chat con vendedores'] as $f)
                    <li class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-sky-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('login') }}" class="block w-full text-center bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 rounded-xl transition-all mb-3">
                    Ingresar como comprador
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center bg-sky-50 hover:bg-sky-100 text-sky-700 font-bold py-3 rounded-xl transition-all text-sm">
                    Crear cuenta gratis
                </a>
            </div>

            {{-- Emprendedor --}}
            <div class="bg-gradient-to-br from-[#0097d9] to-[#0369a1] rounded-3xl p-8 shadow-2xl border border-[#0097d9] hover:shadow-[0_20px_60px_rgba(0,151,217,0.4)] transition-all duration-300 group relative overflow-hidden">
                <div class="absolute top-4 right-4 bg-[#84cc16] text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
                    ⭐ Destacado
                </div>
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                    🚀
                </div>
                <h3 class="text-xl font-extrabold text-white mb-3">Soy Emprendedor</h3>
                <p class="text-blue-100 text-sm leading-relaxed mb-6">
                    Lleva tu negocio al siguiente nivel. Vende en línea, gestiona pedidos y accede a recursos exclusivos para hacer crecer tu emprendimiento.
                </p>
                <ul class="space-y-2 mb-8">
                    @foreach(['Vitrina digital propia', 'Gestión de inventario', 'Analíticas de ventas', 'Mentoría empresarial', 'Pagos integrados PSE'] as $f)
                    <li class="flex items-center gap-2 text-sm text-blue-100">
                        <svg class="w-4 h-4 text-[#84cc16]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('login') }}" class="block w-full text-center bg-white text-[#0097d9] hover:bg-blue-50 font-black py-3 rounded-xl transition-all mb-3">
                    Ingresar a mi panel
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center bg-white/10 hover:bg-white/20 text-white font-bold py-3 rounded-xl transition-all text-sm border border-white/20">
                    Registrar mi emprendimiento
                </a>
            </div>

            {{-- Aliado --}}
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 group">
                <div class="w-16 h-16 bg-lime-100 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                    🤝
                </div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-3">Soy Aliado</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">
                    Empresas, organizaciones e instituciones que quieren apoyar y potenciar el ecosistema emprendedor universitario colombiano.
                </p>
                <ul class="space-y-2 mb-8">
                    @foreach(['Visibilidad de marca', 'Acceso a talento UCC', 'Participación en eventos', 'Reporte de impacto'] as $f)
                    <li class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-lime-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <a href="mailto:alianzas@vitrinaucc.edu.co" class="block w-full text-center bg-lime-500 hover:bg-lime-600 text-white font-bold py-3 rounded-xl transition-all mb-3">
                    Contactar alianzas
                </a>
                <a href="#beneficios" class="block w-full text-center bg-lime-50 hover:bg-lime-100 text-lime-700 font-bold py-3 rounded-xl transition-all text-sm">
                    Ver beneficios
                </a>
            </div>
        </div>
    </div>

    {{-- BENEFICIOS COMUNIDAD --}}
    <div id="beneficios" class="bg-gradient-to-br from-gray-50 to-white py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">¿Por qué unirte a nuestra comunidad?</h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">Más que una plataforma, somos un ecosistema de apoyo mutuo donde todos crecemos juntos.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['ico' => '🌐', 'color' => 'sky', 'titulo' => 'Red de contactos', 'desc' => 'Conecta con más de 500 emprendedores, 50 mentores y 30 empresas aliadas de todo Colombia.'],
                    ['ico' => '📚', 'color' => 'lime', 'titulo' => 'Recursos exclusivos', 'desc' => 'Acceso gratuito a cursos, plantillas, guías de negocio y webinars mensuales con expertos.'],
                    ['ico' => '🏆', 'color' => 'orange', 'titulo' => 'Concursos y premios', 'desc' => 'Participa en convocatorias con premios de hasta $30M COP para financiar tu proyecto.'],
                    ['ico' => '💬', 'color' => 'violet', 'titulo' => 'Comunidad activa', 'desc' => 'Foros, grupos temáticos y eventos presenciales en las 12 sedes UCC del país.'],
                ] as $b)
                @php
                    $bc = [
                        'sky'    => 'bg-sky-50 border-sky-100 text-sky-600',
                        'lime'   => 'bg-lime-50 border-lime-100 text-lime-600',
                        'orange' => 'bg-orange-50 border-orange-100 text-orange-600',
                        'violet' => 'bg-violet-50 border-violet-100 text-violet-600',
                    ];
                @endphp
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all text-center group">
                    <div class="w-14 h-14 {{ $bc[$b['color']] }} border rounded-2xl flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition-transform">
                        {{ $b['ico'] }}
                    </div>
                    <h3 class="font-extrabold text-gray-900 mb-2">{{ $b['titulo'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $b['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- TESTIMONIOS --}}
    <div class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Lo que dice nuestra comunidad</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['texto' => 'Gracias a Vitrina UCC pude monetizar mi habilidad en tejido wayuu y ahora vendo mis bolsos en todo el país. ¡El sueño hecho realidad!', 'nombre' => 'Sandra López', 'rol' => 'Emprendedora · Artesanías del Sol', 'img' => 'photo-1494790108377-be9c29b29330', 'stars' => 5],
                ['texto' => 'La mentoría que recibí fue clave para estructurar mi modelo de negocio. En 3 meses dupliqué mis ventas y abrí un segundo punto de venta.', 'nombre' => 'Julián Herrera', 'rol' => 'Emprendedor · AgroSmart Colombia', 'img' => 'photo-1507003211169-0a1dd7228f2d', 'stars' => 5],
                ['texto' => 'Como empresa aliada hemos encontrado talento increíble para nuestros proyectos de innovación. La comunidad UCC es un vivero de ideas extraordinario.', 'nombre' => 'Patricia Sánchez', 'rol' => 'Directora de Innovación · TechCorp SAS', 'img' => 'photo-1500648767791-00dcc994a43e', 'stars' => 5],
            ] as $t)
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-all">
                <div class="flex mb-4">
                    @for($i=0; $i < $t['stars']; $i++)
                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-6 italic">"{{ $t['texto'] }}"</p>
                <div class="flex items-center gap-3">
                    <img src="https://images.unsplash.com/{{ $t['img'] }}?q=80&w=48&h=48&fit=crop" class="w-12 h-12 rounded-full object-cover border-2 border-gray-100" alt="{{ $t['nombre'] }}">
                    <div>
                        <p class="font-bold text-gray-900 text-sm">{{ $t['nombre'] }}</p>
                        <p class="text-gray-400 text-xs">{{ $t['rol'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- PRÓXIMOS EVENTOS --}}
    <div class="bg-gradient-to-br from-[#0f2027] to-[#2c5364] py-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold text-white mb-4">Próximos eventos</h2>
                <p class="text-gray-400 text-lg">No te pierdas lo que viene en la comunidad</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                    ['fecha' => 'Abr 18', 'tipo' => 'Webinar', 'titulo' => 'Cómo vender en redes sociales sin perder tu identidad de marca', 'hora' => '6:00 PM - 7:30 PM', 'lugar' => 'Online · Zoom', 'color' => 'sky'],
                    ['fecha' => 'Abr 25', 'tipo' => 'Taller', 'titulo' => 'Workshop: Fotografía de producto con tu celular', 'hora' => '9:00 AM - 1:00 PM', 'lugar' => 'UCC Villavicencio', 'color' => 'lime'],
                    ['fecha' => 'May 10', 'tipo' => 'Feria', 'titulo' => 'Feria Emprendedora UCC 2025 — Edición Especial', 'hora' => '8:00 AM - 6:00 PM', 'lugar' => 'Campus Principal UCC', 'color' => 'orange'],
                ] as $e)
                @php
                    $ec = ['sky' => 'text-sky-400 bg-sky-400/10', 'lime' => 'text-lime-400 bg-lime-400/10', 'orange' => 'text-orange-400 bg-orange-400/10'];
                @endphp
                <div class="bg-white/5 rounded-2xl p-6 border border-white/10 hover:bg-white/10 transition-all group">
                    <div class="flex items-start gap-4">
                        <div class="bg-white/10 rounded-xl p-3 text-center min-w-[60px] border border-white/10">
                            <p class="text-white font-black text-lg leading-none">{{ explode(' ', $e['fecha'])[1] }}</p>
                            <p class="text-gray-400 text-xs uppercase">{{ explode(' ', $e['fecha'])[0] }}</p>
                        </div>
                        <div class="flex-1">
                            <span class="text-[10px] font-black uppercase tracking-widest {{ $ec[$e['color']] }} px-2 py-0.5 rounded-full">{{ $e['tipo'] }}</span>
                            <h3 class="text-white font-bold text-sm mt-2 mb-3 leading-snug group-hover:text-[#84cc16] transition">{{ $e['titulo'] }}</h3>
                            <div class="space-y-1">
                                <p class="text-gray-400 text-xs flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $e['hora'] }}
                                </p>
                                <p class="text-gray-400 text-xs flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $e['lugar'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('login') }}" class="block mt-4 text-center text-xs font-bold text-white bg-white/10 hover:bg-white/20 py-2 rounded-lg transition border border-white/10">
                        Inscribirme →
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- CTA FINAL --}}
    <div class="bg-white py-20 px-6">
        <div class="max-w-3xl mx-auto text-center">
            <div class="text-6xl mb-6">🎓</div>
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">¿Aún no eres parte de la comunidad?</h2>
            <p class="text-gray-500 text-lg mb-8">Regístrate gratis hoy y descubre todo lo que la comunidad Vitrina UCC tiene para ti.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-[#0097d9] hover:bg-[#0284c7] text-white font-black px-10 py-4 rounded-2xl shadow-xl shadow-sky-200 transition-all hover:scale-105 text-lg">
                    Unirme a la comunidad
                </a>
                <a href="{{ route('login') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-10 py-4 rounded-2xl transition-all text-lg">
                    Ya tengo cuenta
                </a>
            </div>
        </div>
    </div>

</div>
@endsection