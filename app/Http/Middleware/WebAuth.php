<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WebAuth
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
        if(Auth::user()){

            $admin = ((Auth::user()->usertype=='superadmin') || (Auth::user()->usertype=='admin')) ? true : false;

            if($admin){
                return $next($request);
            }            
        }

        return redirect('/login')->with('fail', 'You Need to Login First to Continue');
        
    }
}
