<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Ambil role melalui relasi
        if (!$user->role || $user->role->name != $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
