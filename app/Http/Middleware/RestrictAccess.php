<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RestrictAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        // 1- check if user is logged in or not
        // 2 - if user is admin or not

        // function isAdmin was create inside user.php
        if(Auth::check() && Auth::user()->isAdmin())
        {
            return $next($request);
        }
       
       
        return redirect('/login');
    }
}
