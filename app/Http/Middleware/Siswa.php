<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Siswa
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
            # code...
        } elseif (Auth::user()->role == 'Siswa') {
            return $next($request);
        }
    }
}
