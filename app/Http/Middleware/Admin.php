<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
            return $next($request);
        } elseif (Auth::user()->role == 'Waka Kurikulum') {
            return "ini halaman waka Kurikulum";
        } elseif (Auth::user()->role == 'Tim PPDB') {
            # code...
        } elseif (Auth::user()->role == 'Siswa') {
            # code...
        }
        
    }
}
