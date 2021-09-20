<?php


namespace App\Http\Middleware;
use Closure;

class CheckLoginUser
{
    public function handle($request, Closure $next)
    {
    	if(!auth()->check())
        {
            return redirect()->route('get.login');
        }
        return $next($request);

    }
}
