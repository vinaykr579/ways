<?php 
namespace App\Http\Middleware;

use Closure;

class AddRouteParametersToRequest {
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        print_r($request->route()); exit;
        return $next($request);

    }

}

