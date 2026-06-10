<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsActive
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if (Auth::check()) {
            $status = Auth::user()->status;

            
            if ($status === 'pending' || $status === 'rejected') {
                
                if ($request->is('dashboard') || $request->is('logout')) {
                    return $next($request);
                }

            
                return redirect()->route('dashboard'); 
            }
            
            if ($status === 'pending') {
                
                if (!$request->is('dashboard') && !$request->is('logout')) {
                    return redirect('/dashboard');
                }
            }
        }

        return $next($request);
    }
}