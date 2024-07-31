<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminAccess
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->roles->contains('name', 'superadmin') || $user->roles->contains('name', 'user admin') || $user->roles->contains('name', 'product admin')) {
                return $next($request);
            }
        }
        return redirect('/');
    }
}
