<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class WakaKurikulum
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
            return $next($request);
        } elseif (Auth::user()->role == 'Tim PPDB') {
            return redirect('/timppdb');
        } elseif (Auth::user()->role == 'Siswa') {
            # code...
        }
    }
}
