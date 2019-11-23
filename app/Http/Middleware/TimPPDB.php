<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class TimPPDB
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 'Admin') {
            # code...
        } elseif (Auth::user()->role == 'Waka Kurikulum') {
            # code...
        } elseif (Auth::user()->role == 'Tim PPDB') {
            return $next($request);
        } elseif (Auth::user()->role == 'Siswa') {
            # code...
        }
    }
}
