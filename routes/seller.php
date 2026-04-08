<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\CommentsController;
use App\Http\Controllers\Seller\ProductsController;
use App\Http\Controllers\Seller\PublicationsController;
use App\Http\Controllers\Seller\BusinessController;



Route::middleware('auth')
    ->prefix('dashboard') // Las URLs empezarán con /dashboard/...
    ->name('user.')      // Los nombres de rutas serán user.index, user.profile, etc.
    ->group(function () {

    // Ver el listado de productos --en uso
    Route::get('/panel-seller', [SellerController::class, 'index'])->name('seller.sellerPanel');
    Route::get('/panel-seller/productos', [ProductsController::class, 'index'])->name('seller.products');
    Route::get('/panel-seller/crear-productos', [ProductsController::class, 'create'])->name('seller.products.create');
    Route::get('/products/store', [ProductsController::class, 'store'])->name('seller.products.store');

    // Ruta POST para guardar (Esta es la que debes poner en el action del form)
    Route::get('/panel-seller/negocio-datos', [BusinessController::class, 'index'])->name('seller.business.index');
    Route::put('/panel-seller/negocio-datos', [BusinessController::class, 'update'])->name('seller.profile.update');







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
        

    });


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    });


require __DIR__.'/auth.php';
