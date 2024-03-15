<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
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
        $superadmin = (Auth::user()->usertype=='superadmin') ? true : false;

            if($superadmin){
                return $next($request);
            }
        return redirect()->back()->with('fail', "You Don't Have The Permission To Access The Link");         
    }
}
