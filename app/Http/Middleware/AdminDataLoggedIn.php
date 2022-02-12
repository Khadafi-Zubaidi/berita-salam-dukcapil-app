<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminDataLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('LoggedAdminData') && (url('login_admin_data')==$request->url())){
            return back();
        }
        return $next($request);
    }
}
