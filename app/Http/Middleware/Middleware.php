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

        // Restrict users without privilege or visibility
        if (!$user->UserPrivilege || !$user->isVisible) {
            Auth::logout();
            return redirect('/login')->withErrors([
                'error' => 'Your account is restricted by the admin for some reasons'
            ]);
        }

        // Prevent redirect loop: only redirect if not already on patient-profile
        if ($user->Role === 'patient' && !$request->is('patient-profile')) {
            return redirect('patient-profile');
        }

    } else {
        return redirect('/login');
    }

    return $next($request);
}

}
