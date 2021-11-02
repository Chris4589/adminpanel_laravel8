<?php

namespace App\Http\Middleware;

use App\Traits\JWTUtils;
use App\Traits\Utils;
use Closure;
use Illuminate\Http\Request;

class AuthVerification
{
    use JWTUtils, Utils;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('x-token');

        $validToken = $this->JWTVerifity($token);

        if (!$validToken) {
            return $this->responses('No authentificado en el servidor', 401, true);
        }
        $request->headers->id = $validToken;
        
        //antes del request
        $response = $next($request);
        //despues
        return $response;
    }
}
