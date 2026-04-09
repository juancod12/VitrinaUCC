<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\PerfilEmprendedores;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener IDs de emprendedores por nombre de negocio
        $emprendedores = PerfilEmprendedores::with('user')->get()->keyBy('nombre_negocio');

        // Obtener IDs de categorías por nombre
        $categorias = DB::table('categorias')->get()->keyBy('nombre');

        $productos = [
            [
                'emprendedor'     => 'Asociación Eco-Sierra',
                'categoria'       => 'Gastronomía y Comida Típica',
                'nombre'          => 'Café Orgánico Sierra Nevada',
                'descripcion'     => 'Café de origen único cultivado en las faldas de la Sierra Nevada. Tostado artesanal con notas a chocolate y frutos rojos.',
                'precio'          => 35000,
                'stock'           => 50,
                'imagen_principal'=> 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?q=80&w=400',
                'estado'          => 'activo',
            ],
            [
                'emprendedor'     => 'Artesanías del Sol',
                'categoria'       => 'Artesanías y Manualidades',
                'nombre'          => 'Bolso Wayuu Tejido a Mano',
                'descripcion'     => 'Bolso mochila tejido a mano por artesanas de la comunidad wayuu. Cada pieza es única, con diseños geométricos tradicionales y colores vibrantes.',
                'precio'          => 120000,
                'stock'           => 20,
                'imagen_principal'=> 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?q=80&w=400',
                'estado'          => 'activo',
            ],
            [
                'emprendedor'     => 'Apicultura Central',
                'categoria'       => 'Productos Orgánicos',
                'nombre'          => 'Miel de Abeja 100% Pura',
                'descripcion'     => 'Miel pura de abeja recolectada en zonas sin contaminación. Sin aditivos ni conservantes. Frasco de 500g.',
                'precio'          => 18000,
                'stock'           => 80,
                'imagen_principal'=> 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?q=80&w=400',
                'estado'          => 'activo',
            ],
            [
                'emprendedor'     => 'Huerta Verde UCC',
                'categoria'       => 'Plantas y Jardinería',
                'nombre'          => 'Kit de Siembra Urbana',
                'descripcion'     => 'Kit completo para iniciar tu huerta en casa: semillas, tierra abonada, macetas biodegradables y guía de cultivo.',
                'precio'          => 45000,
                'stock'           => 30,
                'imagen_principal'=> 'https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?q=80&w=400',
                'estado'          => 'activo',
            ],
            [
                'emprendedor'     => 'Cultura Viva',
                'categoria'       => 'Artesanías y Manualidades',
                'nombre'          => 'Sombrero Vueltiao Tradicional',
                'descripcion'     => 'Sombrero vueltiao auténtico tejido en caña flecha por artesanos cordobeses. Símbolo de la cultura costeña colombiana.',
                'precio'          => 85000,
                'stock'           => 15,
                'imagen_principal'=> 'https://images.unsplash.com/photo-1533659011964-52a4dd7328fa?q=80&w=400',
                'estado'          => 'activo',
            ],
            [
                'emprendedor'     => 'Esencias Naturales',
                'categoria'       => 'Belleza y Cuidado Personal',
                'nombre'          => 'Jabones Artesanales de Coco',
                'descripcion'     => 'Set de 3 jabones artesanales con aceite de coco, karité y esencias naturales. Sin parabenos ni sulfatos. Ideales para piel sensible.',
                'precio'          => 12500,
                'stock'           => 100,
                'imagen_principal'=> 'https://images.unsplash.com/photo-1600857062241-98e5dba7f214?q=80&w=400',
                'estado'          => 'activo',
            ],
        ];

        foreach ($productos as $data) {
            $emprendedor = $emprendedores->get($data['emprendedor']);
            $categoria   = $categorias->get($data['categoria']);

            if (!$emprendedor || !$categoria) {
                $this->command->warn("⚠️  No se encontró emprendedor '{$data['emprendedor']}' o categoría '{$data['categoria']}'");
                continue;
            }

            // Generar slug manualmente para evitar que firstOrCreate omita el evento boot
            $slug = Str::slug($data['nombre']);
            $count = Producto::where('slug', 'LIKE', "{$slug}%")->count();
            $slugFinal = $count ? "{$slug}-{$count}" : $slug;

            Producto::firstOrCreate(
                ['nombre' => $data['nombre']],
                [
                    'emprendedor_id'  => $emprendedor->id,
                    'categoria_id'    => $categoria->id,
                    'slug'            => $slugFinal,
                    'descripcion'     => $data['descripcion'],
                    'precio'          => $data['precio'],
                    'stock'           => $data['stock'],
                    'imagen_principal'=> $data['imagen_principal'],
                    'estado'          => $data['estado'],
                    'eliminado_admin' => false,
                ]
            );
        }

        $this->command->info('✅  6 productos seeded correctamente.');
    }
}