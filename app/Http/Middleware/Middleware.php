<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!$user->UserPrivilege || !$user->isVisible) {
                redirect('/login')->withErrors(['error' => 'Your account is restricted by the admin for some reasons']);
                return Auth::logout();
            }
        } else {
            return redirect('/login');
        }

        return $next($request);
    }
}
