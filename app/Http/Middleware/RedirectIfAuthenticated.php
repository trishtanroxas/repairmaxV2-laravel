<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // If they're authenticated, redirect to their dashboard based on role
                $user = Auth::guard($guard)->user();
                
                if ($user && $user->role === 'admin') {
                    return redirect('/admin/dashboard');
                } elseif ($user && $user->role === 'user') {
                    return redirect('/user/dashboard');
                }

                // Default fallback
                return redirect('/');
            }
        }

        return $next($request);
    }
}
