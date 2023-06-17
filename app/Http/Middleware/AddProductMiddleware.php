<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddProductMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->user()){
            return redirect()->route('mylogin');
        }
        if(isset(auth()->user()->active) && auth()->user()->active == 'on'){

            return $next($request);
        }else{
            return redirect()->route('notactive');
        }; //null

        return $next($request);
    }
}
