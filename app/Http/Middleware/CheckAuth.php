<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuth
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
        dd(Auth::id()); // id() or user() or guest()
        $response = $next($request); // если мы хотим сначала выполнить контроллер, а потом запустить middleware

//        if(Auth::guest()) {
//            return redirect(route('login'));
//        }
//        return $next($request);
        return $response;
    }

    public function terminate($request, $response) {
        // ...
    }

}
