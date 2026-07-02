<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::guard($guard)->user()->role;

                return match ($role) {
                    'admin'     => redirect()->route('dashboard'),
                    'employee'  => redirect()->route('hr.jobs.index'),
                    'candidate' => redirect()->route('candidate.home'),
                    default     => redirect()->route('login'),
                };
            }
        }

        return $next($request);
    }
}