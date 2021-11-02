<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\Utils;
use Closure;
use Illuminate\Http\Request;

class UserVerifity
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
        $user_id = intval($request->query('user_id', 0));
        $id = $request->headers->id->id;
        
        $user = User::findOrFail($id);
        
        if (!$user->roles()->get()->contains('role', User::USER_ROLE) 
            && $user->id !== $user_id) {
            return $this->responses("Recurso no permitido", 401, true);
        }
        return $next($request);
    }
}
