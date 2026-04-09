<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicationsController;


// Ver el listado de productos --en uso
Route::get('/productos', [ProductController::class, 'index'])->name('public.products.index');
Route::post('/productos/{id}/like', [ProductController::class, 'toggleLike'])->middleware('auth');
Route::get('/', function () {
    return view('welcome');
});
Route::post('/publicaciones/{id}/like', [PublicationsController::class, 'toggleLike'])
    ->middleware('auth')
    ->name('publicaciones.like');

Route::post('/publicaciones/{id}/comentar', [PublicationsController::class, 'storeComentario'])
    ->middleware('auth')
    ->name('publicaciones.comentar');
Route::get('/dashboard',[PublicationsController::class, 'index'])->name('dashboard');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
