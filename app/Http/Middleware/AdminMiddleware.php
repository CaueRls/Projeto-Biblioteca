<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verifica se está logado E se é admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // Pode passar!
        }

        // 2. Se não for admin, manda para a Home com erro
        return redirect('/')->with('erro', 'Acesso negado! Área restrita.');
    }
}