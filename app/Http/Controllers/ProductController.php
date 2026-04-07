<?php

namespace App\Http\Controllers;
use app\Models\Producto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Simulación de datos de diferentes comerciantes (Neuromarketing)
        // Usamos objetos para que el Blade los lea como si vinieran de la BD
        $productos = collect([
            (object)[
                'id' => 1,
                'nombre' => 'Café Orgánico Sierra Nevada',
                'precio' => 35000,
                'categoria' => 'Gastronomía',
                'comerciante' => 'Asociación Eco-Sierra',
                'imagen' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?q=80&w=400',
                'badge' => 'Más Vendido'
            ],
            (object)[
                'id' => 2,
                'nombre' => 'Bolso Wayuu Tejido a Mano',
                'precio' => 120000,
                'categoria' => 'Artesanías',
                'comerciante' => 'Artesanías del Sol',
                'imagen' => 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?q=80&w=400',
                'badge' => 'Artesanal'
            ],
            (object)[
                'id' => 3,
                'nombre' => 'Miel de Abeja 100% Pura',
                'precio' => 18000,
                'categoria' => 'Gastronomía',
                'comerciante' => 'Apicultura Central',
                'imagen' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?q=80&w=400',
                'badge' => 'Nuevo'
            ],
            (object)[
                'id' => 4,
                'nombre' => 'Kit de Siembra Urbana',
                'precio' => 45000,
                'categoria' => 'Hogar',
                'comerciante' => 'Huerta Verde UCC',
                'imagen' => 'https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?q=80&w=400',
                'badge' => 'Sostenible'
            ],
            (object)[
                'id' => 5,
                'nombre' => 'Sombrero Vueltiao Tradicional',
                'precio' => 85000,
                'categoria' => 'Artesanías',
                'comerciante' => 'Cultura Viva',
                'imagen' => 'https://images.unsplash.com/photo-1533659011964-52a4dd7328fa?q=80&w=400',
                'badge' => 'Popular'
            ],
            (object)[
                'id' => 6,
                'nombre' => 'Jabones Artesanales de Coco',
                'precio' => 12500,
                'categoria' => 'Belleza',
                'comerciante' => 'Esencias Naturales',
                'imagen' => 'https://images.unsplash.com/photo-1600857062241-98e5dba7f214?q=80&w=400',
                'badge' => 'Eco-Friendly'
            ],
        ]);

        // 2. Retornar la vista con los datos
        // Asegúrate de que la ruta del archivo sea: resources/views/public/products/index.blade.php
        return view('public.products.index', [
            'productos' => $productos,
            'total' => $productos->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
