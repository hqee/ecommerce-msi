<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna adalah admin
        if ($request->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // Jika bukan admin (berarti user biasa), arahkan ke halaman home
        return redirect()->route('home');
    }
}