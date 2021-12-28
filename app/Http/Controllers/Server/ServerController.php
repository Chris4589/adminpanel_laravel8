<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt')->only(['store', 'index', 'show', 'update', 'destroy']);
        $this->middleware('roles')->only(['index', 'show', 'update', 'destroy']);
        $this->middleware('user_id')->only(['store', 'index', 'show', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $servers = Server::all();
        return $this->responses($servers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'user_id' => 'required|min:1',
            'name' => 'required|min:5',
            'foto' => 'required',
            'description' => 'required|min:10',
            'ip' => 'required|min:8',
        ];

        $this->validate($request, $rules);

        $id = $request->query('user_id');
        $data = $request->all();

        $user = User::findOrFail($id);

        $data['foto'] = 'https://i.pinimg.com/originals/4f/df/1d/4fdf1dd0faee0def3ee84a7fa34e96cc.jpgs';

        $newServer = Server::create($data);

        $user->servers()->attach($newServer);

        return $this->responses($newServer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {
        return $this->responses($server);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server)
    {
        $rules = [
            'name' => 'required|min:5',
            'foto' => 'required',
            'description' => 'required|min:10',
            'ip' => 'required|min:8',
        ];

        $this->validate($request, $rules);

        $server->fill($request->only('name', 'foto', 'description', 'ip'));
        $server->save();

        return $this->responses($server);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        $server->delete();
        return $this->responses($server);
    }
}
