<?php


namespace App\Http\Middleware;
use Closure;

class CheckLoginAdmin
{
    public function handle($request, Closure $next)
    {
        if(!auth()->check())
        {
            return redirect()->route('get.login');
        }
        else if(auth()->user()->type ==1){
        	auth()->logout();
        	return redirect()->route('get.login');
        }
        return $next($request);
    }
}
