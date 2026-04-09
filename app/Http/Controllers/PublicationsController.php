<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\MeEncanta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationsController extends Controller
{
    public function index(Request $request)
    {
        // Cargamos las publicaciones con sus relaciones y el conteo de interacciones
        $publicaciones = Publicacion::with(['emprendedor', 'comentarios.user'])
            ->withCount(['meEncantas', 'comentarios'])
            ->where('estado', 'activo')
            ->when($request->search, function($query, $search) {
                $query->where('titulo', 'like', "%{$search}%")
                        ->orWhere('contenido', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard', compact('publicaciones'));
    }

    /**
     * Lógica para actualizar el "Me encanta" vía AJAX
     */
    public function toggleLike(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Inicia sesión primero'], 401);
        }

        $publicacion = Publicacion::findOrFail($id);
        
        // Buscamos si ya existe el like (Relación Polimórfica según tu BD)
        $like = $publicacion->meEncantas()->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
            $status = 'removed';
        } else {
            $publicacion->meEncantas()->create([
                'user_id' => Auth::id(),
                // interaccionable_id e interaccionable_type se llenan solos por morphMany
            ]);
            $status = 'added';
        }

        return response()->json([
            'status' => $status,
            'count' => $publicacion->meEncantas()->count()
        ]);
    }

    public function storeComentario(Request $request, $id)
    {
        $request->validate([
            'contenido' => 'required|string|max:500',
            'estrellas' => 'required|integer|min:1|max:5',
        ]);

        $comentario = new \App\Models\Comentario();
        $comentario->user_id = auth()->id();
        $comentario->contenido = $request->contenido;
        $comentario->estrellas = $request->estrellas;
        $comentario->comentable_id = $id;
        $comentario->comentable_type = \App\Models\Publicacion::class;
        $comentario->save();

        // Redireccionamos a la misma URL añadiendo el ancla de la sección de comentarios
        return redirect()->to(url()->previous() . '#comentarios-' . $id)
                        ->with('success', 'Tu comentario ha sido publicado.');
    }
}