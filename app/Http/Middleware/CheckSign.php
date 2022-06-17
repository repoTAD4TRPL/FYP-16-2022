<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class CheckSign
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        if(Session::get('status') == "is_admin"){
            // return redirect('/administrator/dashboard');
        } else{
            return redirect('/');
        }
        return $next($request);
    }
}
