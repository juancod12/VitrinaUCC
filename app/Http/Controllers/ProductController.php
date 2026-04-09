<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        // Productos reales desde la BD con sus relaciones
        $productos = Producto::with(['emprendedor', 'categoria'])
            ->where('estado', 'activo')
            ->where('eliminado_admin', false)
            ->latest()
            ->get();

        // IDs de favoritos del usuario autenticado (para pintar el corazón)
        $favoritosIds = collect();
        if (Auth::check()) {
            $favoritosIds = Auth::user()->favoritos()->pluck('producto_id');
        }

        return view('public.products.index', [
            'productos'    => $productos,
            'favoritosIds' => $favoritosIds,
            'total'        => $productos->count(),
        ]);
    }
}