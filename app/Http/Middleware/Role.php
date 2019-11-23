<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
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
            return redirect('/dashboard-admin');
        } elseif (Auth::user()->role == 'Waka Kurikulum') {
            return redirect('/dashboard-waka-kurikulum');
        } elseif (Auth::user()->role == 'Tim PPDB') {
            return redirect('/dashboard-tim-ppdb');
        } elseif (Auth::user()->role == 'Siswa') {
            return redirect('/homepage');
        }
    }
}
