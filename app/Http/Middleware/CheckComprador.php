<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckComprador
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificamos si hay usuario logueado Y si su rol es 'comprador'
        if (auth()->check() && auth()->user()->rol === 'emprendedor') {
            return $next($request);
        }

        // Si no es comprador, lo mandamos afuera con un error
        abort(403, 'Lo sentimos, solo los usuarios con rol comprador pueden entrar aquí.');
    }
}
