<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\JWTUtils;
use Illuminate\Http\Request;

class TokenGenerate extends Controller
{
    use JWTUtils;

    public function __construct()
    {
      $this->middleware('jwt')->only('store');
      /* $this->middleware('user_id')->only(['store']); */
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $id = $request->headers->id->id;
      $user = User::findOrFail($id);
      
      $token = $this->JWTSign(['id' => $user->id]);
      $roles = $user->roles()->select('role', 'name')->get();
      $array = array_merge($user->toArray(), ['token' => $token, 'roles' => $roles]);
      return $this->responses($array);
    }
}
