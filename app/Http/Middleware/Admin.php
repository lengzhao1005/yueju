<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        $str = preg_replace('/\d+/','*',$request->getPathInfo()).'__'.strtoupper($request->method());

        $user_permiss = Auth::user()->getPermissions()->toArray();

        if(!in_array($str,$user_permiss) && Auth::user()->is_admin!=2){

            abort(403,'权限不足，请联系管理员');
        }
        return $next($request);

    }
}
