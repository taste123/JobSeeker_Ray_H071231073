<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Employer
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'employer') {
            return $next($request);
        }

        return redirect('/');
    }
}
