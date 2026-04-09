<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Direccion;
use App\Models\Favorito;
use App\Models\Pedido;
use App\Models\PerfilComprador;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BuyerController extends Controller
{
    // ─── Dashboard ───────────────────────────────────────────────
    public function dashboard()
    {
        $user = Auth::user();

        return view('user.dashboard', [
            'totalPedidos'     => $user->pedidos()->count(),
            'cartItems'        => collect(session('cart'))->sum('cantidad'),
            'totalDirecciones' => $user->direcciones()->count(),
            'totalFavoritos'   => $user->favoritos()->count(),
            'pedidosRecientes' => $user->pedidos()->latest()->take(5)->get(),
        ]);
    }

    // ─── Perfil ───────────────────────────────────────────────────
    public function profile()
    {
        $perfil = Auth::user()->perfilComprador ?? new PerfilComprador();
        return view('user.profile', compact('perfil'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        PerfilComprador::updateOrCreate(
            ['user_id' => $user->id],
            [
                'telefono' => $request->telefono,
                'ciudad'   => $request->ciudad,
            ]
        );

        return redirect()->route('user.buyer.profile')->with('status', 'profile-updated');
    }

    // ─── Favoritos ────────────────────────────────────────────────
    public function favorites()
    {
        $favoritos = Auth::user()
            ->productosFavoritos()
            ->with('emprendedor')
            ->paginate(12);

        return view('user.favorites', compact('favoritos'));
    }

    public function toggleFavorite($productoId)
    {
        $user = Auth::user();

        $favorito = Favorito::where('user_id', $user->id)
            ->where('producto_id', $productoId)
            ->first();

        if ($favorito) {
            $favorito->delete();
            $message = 'Producto eliminado de favoritos.';
            $isFav   = false;
        } else {
            Favorito::create([
                'user_id'     => $user->id,
                'producto_id' => $productoId,
            ]);
            $message = '¡Producto añadido a favoritos!';
            $isFav   = true;
        }

        if (request()->ajax()) {
            return response()->json(['favorito' => $isFav, 'message' => $message]);
        }

        return back()->with('success', $message);
    }

    // ─── Carrito ──────────────────────────────────────────────────
    public function cart()
    {
        return view('user.cart');
    }

    public function addToCart(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['cantidad']++;
        } else {
            $cart[$id] = [
                'nombre'      => $producto->nombre,
                'precio'      => $producto->precio,
                'imagen'      => $producto->imagen_principal ?? null,
                'comerciante' => optional($producto->emprendedor)->nombre_negocio ?? 'Vitrina UCC',
                'cantidad'    => 1,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', '¡Producto añadido al carrito!');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($request->action === 'increment') {
                $cart[$id]['cantidad']++;
            } elseif ($request->action === 'decrement') {
                $cart[$id]['cantidad']--;
                if ($cart[$id]['cantidad'] <= 0) {
                    unset($cart[$id]);
                }
            }
        }

        session()->put('cart', $cart);
        return back();
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back()->with('success', 'Producto eliminado del carrito.');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return back()->with('success', 'Carrito vaciado.');
    }

    // ─── Checkout ─────────────────────────────────────────────────
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('user.buyer.cart')->with('error', 'Tu carrito está vacío.');
        }

        $direcciones = Auth::user()->direcciones()->get();
        $subtotal    = collect($cart)->sum(fn($i) => $i['precio'] * $i['cantidad']);

        return view('user.checkout', compact('cart', 'direcciones', 'subtotal'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('user.buyer.cart');
        }

        $request->validate([
            'direccion_entrega' => 'required|string|max:500',
            'metodo_pago'       => 'required|in:pse,tarjeta,contra_entrega',
        ]);

        // Simular referencia de pago
        $referencia = null;
        if (in_array($request->metodo_pago, ['pse', 'tarjeta'])) {
            $referencia = strtoupper(Str::random(4)) . '-' . rand(1000, 9999);
        }

        $total = collect($cart)->sum(fn($i) => $i['precio'] * $i['cantidad']) + 5000;

        $pedido = Pedido::create([
            'comprador_id'      => Auth::id(),
            'total'             => $total,
            'estado'            => 'pendiente',
            'direccion_entrega' => $request->direccion_entrega,
            'metodo_pago'       => $request->metodo_pago,
            'referencia_pago'   => $referencia,
        ]);

        foreach ($cart as $productoId => $item) {
            $pedido->items()->create([
                'producto_id'     => $productoId,
                'cantidad'        => $item['cantidad'],
                'precio_unitario' => $item['precio'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('user.buyer.orders.show', $pedido->id)
            ->with('success', '¡Pedido #' . $pedido->id . ' realizado con éxito!');
    }

    // ─── Pedidos ──────────────────────────────────────────────────
    public function orders()
    {
        $pedidos = Auth::user()
            ->pedidos()
            ->with('items.producto')
            ->latest()
            ->paginate(10);

        return view('user.orders', compact('pedidos'));
    }

    public function orderShow($id)
    {
        $pedido = Auth::user()->pedidos()->with('items.producto')->findOrFail($id);
        return view('user.order-detail', compact('pedido'));
    }

    // ─── Direcciones ──────────────────────────────────────────────
    public function addresses()
    {
        $direcciones = Auth::user()->direcciones()->get();
        return view('user.addresses', compact('direcciones'));
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'direccion'    => 'required|string|max:255',
            'ciudad'       => 'required|string|max:100',
            'departamento' => 'required|string|max:100',
        ]);

        if ($request->boolean('principal')) {
            Auth::user()->direcciones()->update(['principal' => false]);
        }

        Auth::user()->direcciones()->create([
            'direccion'    => $request->direccion,
            'ciudad'       => $request->ciudad,
            'departamento' => $request->departamento,
            'principal'    => $request->boolean('principal'),
        ]);

        return back()->with('success', 'Dirección guardada correctamente.');
    }

    public function setPrincipalAddress($id)
    {
        Auth::user()->direcciones()->update(['principal' => false]);
        Auth::user()->direcciones()->findOrFail($id)->update(['principal' => true]);
        return back()->with('success', 'Dirección principal actualizada.');
    }

    public function destroyAddress($id)
    {
        Auth::user()->direcciones()->findOrFail($id)->delete();
        return back()->with('success', 'Dirección eliminada.');
    }
}
