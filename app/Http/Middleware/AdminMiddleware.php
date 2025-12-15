<?php

namespace App\Http\Middleware; // Pastikan namespace ini benar

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware // Pastikan nama kelas ini benar
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        if (Auth::check()) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }
        return redirect('/login');
    }
}