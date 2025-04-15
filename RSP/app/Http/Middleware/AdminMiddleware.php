<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

// class AdminMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next): Response
//     {
//         return $next($request);
//     }
// }

// namespace App\Http\Middleware;
// use Illuminate\Http\Request;
// use Closure;
// use Illuminate\Support\Facades\Auth;
// class AdminMiddleware
// {
    // public function handle($request, Closure $next)
// {
// if (Auth::check() && Auth::user()->role == 'admin') {
// return $next($request);
// }

    // // Redirect non-admin users to home page or error page
// return redirect('/')->with('error', 'You do not have
// access to this page.');
// }

//     public function handle(Request $request, Closure $next)
//     {
//         if (Auth::check() && Auth::user()->role === 'admin') {
//             return $next($request);
//         }

//         return redirect('/dashboard')->with('error', 'Access denied.');
//     }
// }

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
public function handle($request, Closure $next)
{
if (Auth::check() && Auth::user()->role == 'admin') {
return $next($request);
}

// Redirect non-admin users to home page or error page
return redirect('/home')->with('error', 'You do not have
access to this page.');
}
}
