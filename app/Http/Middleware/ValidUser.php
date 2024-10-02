<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if ($request->routeIs('show_login') || $request->routeIs('show_register')) {
                return redirect()->route('home')->with('Res', 'You have no access to this route!');
            }
        } else {
            if ($request->routeIs('profile')) {
                return redirect()->route('home')->with('Res', 'You have no access to this route!');
            }
        }
        return $next($request);

    }
}
