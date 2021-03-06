<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Rango;
use App\Models\Server;
use Illuminate\Http\Request;

class ServerRangoAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt')->only(['store']);
        /* $this->middleware('roles')->only(['store']); */
        $this->middleware('user_id')->only(['store']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Server $server, Rango $rango)
    {
        $rules = [
            'steamid' => 'required|min:2',
            'name' => 'required|min:2',
            'type' => 'required|integer|min:0',
            'password' => 'required|min:4',
            'date' => 'required|date',
        ];

        $this->validate($request, $rules);

        $admin = $request->only('steamid', 'name', 'type', 'password', 'date');
        $admin['fk_server'] = $server->id;
        $admin['fk_rango'] = $rango->id;

        $newAdmin = Admin::create($admin);

        return $this->responses($newAdmin);
    }
}
