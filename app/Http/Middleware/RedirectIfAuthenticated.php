<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
                // switch ($guard) {
                //     case 'user':
                //         return redirect()->route('user.dashboard');
                //     case 'admin':
                //         return redirect()->route('admin.dashboard');
                //     default:
                //         return redirect('/');
                // }
                if (Auth::user()->role == 'user') {
                    return redirect('/dashboard');
                }
                else if (Auth::user()->role == 'manager') {
                    return redirect('/manager/dashboard');
                }
                else if (Auth::user()->role == 'admin') {
                    return redirect('/admin/dashboard');
                }
            }
        }

        return $next($request);
    }
}
