<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyToken
{
    public function handle(Request $request, Closure $next, $role = null)
    {
        // Cek apakah user sudah login (tidak pakai token lagi)
        if (!session()->has('id') || !session()->has('role')) {
            return redirect()->route('login')
                ->withErrors(['login_error' => 'Silakan login terlebih dahulu']);
        }

        // Cek role jika ada parameter role
        if ($role && session('role') !== $role) {
            return redirect()->route('dashboard')
                ->withErrors(['error' => 'Anda tidak memiliki akses ke halaman ini']);
        }

        return $next($request);
    }
}
