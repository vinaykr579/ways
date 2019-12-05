<?php 
namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class AddTokenToRequest {
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = explode(' ',$request->headers->all()['authorization'][0])[1];
        JWTAuth::setToken($token);
        $payload = JWTAuth::toUser($token);
        $input = $request->all();
        $input['User'] = $payload;
        $request->merge($input);
        return $next($request);

    }

}

