<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\MeEncanta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. Cargar categorías para el sidebar con conteo de productos
        $categorias = Categoria::withCount('productos')->get();

        // 2. Query base de productos con relaciones necesarias
        $query = Producto::with(['categoria', 'emprendedor'])
            ->where('estado', 'activo');

        // 3. Filtro por búsqueda (nombre o descripción)
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->search . '%')
                  ->orWhere('descripcion', 'like', '%' . $request->search . '%');
            });
        }

        // 4. Filtro por categoría (usando el slug)
        if ($request->filled('categoria')) {
            $query->whereHas('categoria', function($q) use ($request) {
                $q->where('slug', $request->categoria);
            });
        }

        // 5. Ordenamiento
        $sort = $request->get('sort', 'recent');
        if ($sort === 'price_low') {
            $query->orderBy('precio', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $productos = $query->paginate(12)->withQueryString();

        return view('public.products.index', compact('productos', 'categorias'));
    }

    /**
     * Lógica para el botón "Me encanta"
     */
    public function toggleLike(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Debes iniciar sesión'], 401);
        }

        $userId = Auth::id();
        $like = MeEncanta::where('user_id', $userId)
            ->where('interaccionable_id', $id)
            ->where('interaccionable_type', Producto::class)
            ->first();

        if ($like) {
            $like->delete();
            $status = 'removed';
        } else {
            MeEncanta::create([
                'user_id' => $userId,
                'interaccionable_id' => $id,
                'interaccionable_type' => Producto::class
            ]);
            $status = 'added';
        }

        return response()->json(['status' => $status]);
    }
}