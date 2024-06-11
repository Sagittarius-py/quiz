<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, $role)
    {
        if ($role == 'teacher' && Auth::user()->permission > 0) {
            return $next($request);
        } elseif ($role == 'student' && Auth::user()->permission == 0) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
