<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationsController extends Controller
{
    /**
     * Muestra el muro de publicaciones del emprendedor.
     */
    public function index()
    {
        // 1. Obtenemos el perfil del emprendedor logueado
        $perfil = Auth::user()->perfilEmprendedor;

        // 2. Si no tiene perfil, lo redirigimos (seguridad extra)
        if (!$perfil) {
            return view('seller.publications.profile-required');
        }

        // 3. Cargamos las publicaciones del emprendedor
        // Usamos withCount para obtener el número de likes y comentarios sin cargar todos los registros
        $publicaciones = Publicacion::where('emprendedor_id', $perfil->id)
            ->withCount(['meEncantas', 'comentarios'])
            ->latest() // Ordenar de la más reciente a la más antigua
            ->paginate(12); // Paginación para que no explote si tiene 500 posts

        // 4. Retornamos la vista (Asegúrate de que la ruta de la vista sea correcta)
        return view('seller.publications.index', compact('publicaciones', 'perfil'));
    }

public function create()
    {
        return view('seller.publications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'multimedia' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480', // 20MB max
            'seccion' => 'nullable|string',
            'estado' => 'required|in:activo,borrador'
        ]);

        $perfil = auth()->user()->perfilEmprendedor;

        $tipo_multimedia = 'ninguno';
        $ruta_multimedia = null;

        if ($request->hasFile('multimedia')) {
            $file = $request->file('multimedia');
            $extension = $file->getClientOriginalExtension();
            $tipo_multimedia = in_array($extension, ['mp4', 'mov', 'avi']) ? 'video' : 'imagen';
            $ruta_multimedia = $file->store('publicaciones', 'public');
        }

        Publicacion::create([
            'emprendedor_id' => $perfil->id,
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'multimedia' => $ruta_multimedia,
            'tipo_multimedia' => $tipo_multimedia,
            'seccion' => $request->seccion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('user.seller.publications.index')->with('success', 'Publicación creada con éxito.');
    }

    public function edit($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        // Seguridad
        if ($publicacion->emprendedor_id !== auth()->user()->perfilEmprendedor->id) abort(403);

        return view('seller.publications.edit', compact('publicacion'));
    }

    public function update(Request $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);
        if ($publicacion->emprendedor_id !== auth()->user()->perfilEmprendedor->id) abort(403);

        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'estado' => 'required|in:activo,borrador'
        ]);

        if ($request->hasFile('multimedia')) {
            // Borrar anterior
            if ($publicacion->multimedia) Storage::disk('public')->delete($publicacion->multimedia);
            
            $file = $request->file('multimedia');
            $extension = $file->getClientOriginalExtension();
            $publicacion->tipo_multimedia = in_array($extension, ['mp4', 'mov', 'avi']) ? 'video' : 'imagen';
            $publicacion->multimedia = $file->store('publicaciones', 'public');
        }

        $publicacion->update([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'seccion' => $request->seccion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('user.seller.publications.index')->with('success', 'Actualizado correctamente.');
    }

    public function destroy($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        if ($publicacion->emprendedor_id !== auth()->user()->perfilEmprendedor->id) abort(403);

        if ($publicacion->multimedia) Storage::disk('public')->delete($publicacion->multimedia);
        $publicacion->delete();

        return back()->with('success', 'Publicación eliminada.');
    }
}
