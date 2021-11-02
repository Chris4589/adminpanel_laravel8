<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\Utils;
use Closure;
use Illuminate\Http\Request;

class RoleUser
{
    use Utils;
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->headers->id->id;
        
        $user = User::findOrFail($id);
        
        if (!$user->roles()->get()->contains('role', User::USER_ROLE)) {
            return $this->responses('No eres administrador', 401, true);
        }
        return $next($request);
    }
}
