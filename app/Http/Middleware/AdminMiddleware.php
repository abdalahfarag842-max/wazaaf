<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        if (!in_array($userRole, $roles)) {
            return match ($userRole) {
                'admin'     => redirect()->route('dashboard'),
                'employee'  => redirect()->route('hr.jobs.index'),
                'candidate' => redirect()->route('candidate.home'),
                default     => redirect()->route('login'),
            };
        }

        return $next($request);
    }
}