<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Ver el listado de productos --en uso
Route::get('/productos', [ProductController::class, 'index'])->name('public.products.index');

// Mostrar formulario de creación
Route::get('/productos/crear', [ProductController::class, 'create'])->name('public.products.create');

// Guardar el producto (POST)
Route::post('/productos', [ProductController::class, 'store'])->name('public.products.store');

// Ver un producto específico
Route::get('/productos/{id}', [ProductController::class, 'show'])->name('public.products.show');

// Mostrar formulario de edición
Route::get('/productos/{id}/editar', [ProductController::class, 'edit'])->name('public.products.edit');

// Actualizar el producto (PUT o PATCH)
Route::put('/productos/{id}', [ProductController::class, 'update'])->name('public.products.update');

// Eliminar el producto (DELETE)
Route::delete('/productos/{id}', [ProductController::class, 'destroy'])->name('public.products.destroy');



Route::middleware('auth')
    ->prefix('dashboard') // Las URLs empezarán con /dashboard/...
    ->name('user.')      // Los nombres de rutas serán user.index, user.profile, etc.
    ->group(function () {
        

    });


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    });
require __DIR__.'/auth.php';
