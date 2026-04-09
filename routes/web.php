<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


// Página principal
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Páginas públicas
Route::get('/productos',  [ProductController::class, 'index'])->name('public.products.index');
Route::get('/servicios', fn() => view('public.products.servicios'))->name('public.servicios');
Route::get('/proyectos',  fn() => view('public.products.proyectos'))->name('public.proyectos');
Route::get('/comunidad',  fn() => view('public.products.comunidad'))->name('public.comunidad');

// Perfil autenticado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/buyer.php';