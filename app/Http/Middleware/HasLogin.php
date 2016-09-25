<?php

namespace App\Http\Middleware;

use Closure,Auth,Json;

class HasLogin{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $user=Auth::user();
        if($user&&$user->id>0){
            return $next($request);
        }else{
            return Json::response(12);
        }
    }
}
