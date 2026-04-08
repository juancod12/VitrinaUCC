<?php

namespace App\Http\Controllers\Seller;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\PerfilEmprendedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index()
    {
        $productos = Producto::where('emprendedor_id', Auth::user()->id)
                            ->with('categoria') // Eager loading para no saturar la BD
                            ->latest()
                            ->paginate(10);

        return view('seller.products.index', compact('productos'));
    }
    /**
     * Muestra el formulario de creación.
     */
    public function create()
    {
        // Obtenemos todas las categorías ordenadas alfabéticamente
        $categorias = \App\Models\Categoria::orderBy('nombre', 'asc')->get();
        
        return view('seller.products.create', compact('categorias'));
    }

    /**
     * Almacena el producto en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validación de datos
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'categoria_id'     => 'required|exists:categorias,id',
            'descripcion'      => 'required|string',
            'precio'           => 'required|numeric|min:0',
            'stock'            => 'required|integer|min:0',
            'imagen_principal' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'estado'           => 'required|in:activo,borrador',
        ]);

        // Obtener el perfil de emprendedor del usuario autenticado
        // Ajusta 'perfilEmprendedor' según el nombre de la relación en tu modelo User
        $perfil = Auth::user()->perfilEmprendedor;

        if (!$perfil) {
            return back()->with('error', 'No tienes un perfil de emprendedor asociado.');
        }

        $path = null;

        try {
            // 2. Manejo de la imagen principal
            if ($request->hasFile('imagen_principal')) {
                // Guardar con un nombre único para evitar conflictos
                $path = $request->file('imagen_principal')->store('productos', 'public');
            }

            // 3. Creación del producto
            Producto::create([
                'emprendedor_id'   => $perfil->id, // USAMOS EL ID DEL PERFIL, NO DEL USER
                'categoria_id'     => $request->categoria_id,
                'nombre'           => $request->nombre,
                'descripcion'      => $request->descripcion,
                'precio'           => $request->precio,
                'stock'            => $request->stock,
                'imagen_principal' => $path,
                'estado'           => $request->estado,
                'eliminado_admin'  => false,
            ]);

            return redirect()->route('user.seller.products') // Asegúrate de que este sea el nombre de tu ruta index
                ->with('success', '¡Producto creado exitosamente!');

        } catch (\Exception $e) {
            // En caso de error, borrar la imagen subida para no dejar basura en el servidor
            if ($path) {
                \Storage::disk('public')->delete($path);
            }

            return back()->withInput()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }
}