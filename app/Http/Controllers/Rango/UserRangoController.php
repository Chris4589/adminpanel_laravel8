<?php

namespace App\Http\Controllers\Rango;

use App\Http\Controllers\Controller;
use App\Models\Rango;
use App\Models\User;
use Illuminate\Http\Request;

class UserRangoController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt')->only(['store', 'index']);
        /* $this->middleware('roles')->only(['store', 'index']); */
        $this->middleware('user_id')->only(['store', 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $rangos = $user->rangos()->select('id', 'name', 'description', 'flags')->get();
        return $this->responses($rangos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|min:4',
            'description' => 'required|min:8',
            'flags' => 'required|min:4',
        ];

        $this->validate($request, $rules);

        $rango = $request->only('fk_user', 'name', 'description', 'flags');
        $rango['fk_user'] = $user->id;

        $range = Rango::create($rango);

        return $this->responses($range);
    }
}
