<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class JobSeeker
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'job_seeker') {
            return $next($request);
        }

        return redirect('/');
    }
}
