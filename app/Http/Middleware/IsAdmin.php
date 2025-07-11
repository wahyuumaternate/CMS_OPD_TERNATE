<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Misalnya diasumsikan user punya field 'is_admin' di tabel users
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Hanya admin yang bisa mengakses.');
    }
}
