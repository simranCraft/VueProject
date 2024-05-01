<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmployeeAccessControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->employee->user_id !== auth()->user()->id && !$request->user()->hasRole('super-admin')) {
            return abort( 403, 'You cannot access the employees of other user');
        }

        return $next($request);
    }
}