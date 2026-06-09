<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {  
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->usertype;

        if ($userRole !== $role) {
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($userRole === 'accounts_officer') {
                return redirect()->route('accounts.dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }
        return $next($request);
    }
}
