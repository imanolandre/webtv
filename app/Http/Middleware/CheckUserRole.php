<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Si no está logueado, mandarlo al login
        if (!Auth::check()) {
            return redirect()->route('filament.admin.auth.login');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 2. Verificación de Shield
        // Si el usuario NO tiene el rol de super_admin e intenta entrar al panel
        if ($request->is('admin*') && !$user->hasRole('super_admin')) {
            return redirect('/');
        }


        return $next($request);
    }
}
