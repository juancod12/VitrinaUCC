<?php

use App\Http\Controllers\User\BuyerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->prefix('mi-cuenta')
    ->name('user.buyer.')
    ->group(function () {

    // Dashboard
    Route::get('/', [BuyerController::class, 'dashboard'])->name('dashboard');

    // Perfil
    Route::get('/perfil', [BuyerController::class, 'profile'])->name('profile');
    Route::patch('/perfil', [BuyerController::class, 'updateProfile'])->name('profile.update');

    // Favoritos
    Route::get('/favoritos', [BuyerController::class, 'favorites'])->name('favorites');
    Route::post('/favoritos/{id}', [BuyerController::class, 'toggleFavorite'])->name('favorites.toggle');

    // Carrito
    Route::get('/carrito', [BuyerController::class, 'cart'])->name('cart');
    Route::post('/carrito/{id}', [BuyerController::class, 'addToCart'])->name('cart.add');
    Route::patch('/carrito/{id}', [BuyerController::class, 'updateCart'])->name('cart.update');
    Route::delete('/carrito/{id}', [BuyerController::class, 'removeFromCart'])->name('cart.remove');
    Route::delete('/carrito', [BuyerController::class, 'clearCart'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [BuyerController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [BuyerController::class, 'placeOrder'])->name('checkout.place');

    // Pedidos
    Route::get('/pedidos', [BuyerController::class, 'orders'])->name('orders');
    Route::get('/pedidos/{id}', [BuyerController::class, 'orderShow'])->name('orders.show');

    // Direcciones
    Route::get('/direcciones', [BuyerController::class, 'addresses'])->name('addresses');
    Route::post('/direcciones', [BuyerController::class, 'storeAddress'])->name('addresses.store');
    Route::patch('/direcciones/{id}/principal', [BuyerController::class, 'setPrincipalAddress'])->name('addresses.principal');
    Route::delete('/direcciones/{id}', [BuyerController::class, 'destroyAddress'])->name('addresses.destroy');
});
