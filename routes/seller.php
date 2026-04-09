<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\CommentsController;
use App\Http\Controllers\Seller\ProductsController;
use App\Http\Controllers\Seller\PublicationsController;
use App\Http\Controllers\Seller\BusinessController;



Route::middleware('auth', 'emprendedor')
    ->prefix('dashboard') // Las URLs empezarán con /dashboard/...
    ->name('user.')      // Los nombres de rutas serán user.index, user.profile, etc.
    ->group(function () {

    // Ver el listado de productos --en uso
    Route::get('/panel-seller', [SellerController::class, 'index'])->name('seller.sellerPanel');
    Route::get('/panel-seller/productos', [ProductsController::class, 'index'])->name('seller.products');
    Route::get('/panel-seller/crear-productos', [ProductsController::class, 'create'])->name('seller.products.create');

    Route::get('/panel-seller/negocio', [BusinessController::class, 'index'])->name('seller.business.index');
    Route::put('/panel-seller/negocio', [BusinessController::class, 'update'])->name('seller.profile.update');

    Route::put('/dashboard/products/{id}', [ProductsController::class, 'update'])->name('seller.products.update');

    Route::get('/dashboard/products/{id}', [ProductsController::class, 'edit'])->name('seller.products.edit');

    Route::post('/products/store', [ProductsController::class, 'store'])->name('seller.products.store');

    Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('seller.products.destroy');

    Route::resource('/publicaciones', PublicationsController::class)->names('seller.publications');

    });

require __DIR__.'/auth.php';
