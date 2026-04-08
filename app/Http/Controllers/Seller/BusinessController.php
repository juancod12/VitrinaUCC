<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Obtenemos el perfil del usuario autenticado
        // Usamos la relación definida en el modelo User
        $perfil = auth()->user()->perfilEmprendedor;

        // 2. Si no existe un perfil creado aún, podemos enviar null 
        // o crear una instancia vacía para que la vista no explote
        if (!$perfil) {
            // Opción A: Crear un registro básico vacío si quieres que siempre exista
            /*
            $perfil = \App\Models\PerfilEmprendedor::create([
                'user_id' => auth()->id(),
                'nombre_negocio' => 'Mi Nuevo Negocio'
            ]);
            */
        }

        // 3. Retornamos la vista pasando la variable 'perfil'
        return view('seller.business.index', compact('perfil'));
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
    public function update(Request $request)
    {
        // 1. Validaciones estrictas
        $request->validate([
            'nombre_negocio'  => 'required|string|max:255',
            'descripcion'     => 'required|string|min:10',
            'telefono'        => 'required|string|max:20',
            'correo_contacto' => 'required|email|max:255',
            'sitio_web'       => 'nullable|url',
            'logo'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        // 2. Buscar el perfil o crear una instancia nueva vinculada al usuario
        $perfil = PerfilEmprendedor::firstOrNew(['user_id' => auth()->id()]);

        // 3. Asignar datos básicos
        $perfil->nombre_negocio = $request->nombre_negocio;
        $perfil->descripcion    = $request->descripcion;
        $perfil->telefono       = $request->telefono;
        $perfil->correo_contacto = $request->correo_contacto;
        $perfil->sitio_web      = $request->sitio_web;

        // 4. Manejo del LOGO
        if ($request->hasFile('logo')) {
            // Eliminar logo anterior si existe
            if ($perfil->logo) {
                Storage::disk('public')->delete($perfil->logo);
            }
            $perfil->logo = $request->file('logo')->store('negocios/logos', 'public');
        }

        // 5. Manejo del BANNER
        if ($request->hasFile('banner')) {
            // Eliminar banner anterior si existe
            if ($perfil->banner) {
                Storage::disk('public')->delete($perfil->banner);
            }
            $perfil->banner = $request->file('banner')->store('negocios/banners', 'public');
        }

        // 6. Guardar en la DB (perfil_emprendedores)
        $perfil->save();

        return back()->with('success', '¡Perfil de negocio actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
