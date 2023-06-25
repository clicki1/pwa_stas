<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()) {
            return redirect()->route('mylogin');
        }

        if (isset(auth()->user()->role) && auth()->user()->role == 'admin' && auth()->user()->active == 'on') {
            return $next($request);
        }; //null
        
        if (isset(auth()->user()->role) && auth()->user()->role == 'worker' && auth()->user()->active == 'on') {
            return redirect()->route('product.create');
   }; //null
//        return $next($request);
        return redirect()->route('notactive');
    }
}
