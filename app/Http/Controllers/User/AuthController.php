<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\JWTUtils;

class AuthController extends Controller
{
    use JWTUtils;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ];

        $this->validate($request, $rules);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->responses('Correo o Contraseña incorrecta', 401, true);
        }

        if (!Hash::check($request->password, $user->password)) {
            return $this->responses('Contraseña incorrecta', 401, true);
        }

        $roles = $user->roles()->select('role', 'name')->get();
        $token = $this->JWTSign(['id' => $user->id]);

        $array = array_merge($user->toArray(), ['token' => $token, 'roles' => $roles]);
        
        return $this->responses($array);
    }

}
