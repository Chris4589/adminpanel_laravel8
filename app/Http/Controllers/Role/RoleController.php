<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt')->only(['edit', 'create', 'destroy', 'store']);
        $this->middleware('roles')->only(['edit', 'create', 'destroy', 'store']);
        $this->middleware('user_id')->only(['edit', 'create', 'destroy', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return $this->responses($roles);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $this->responses($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $rules = [
            'name' => 'required|min:5',
            'description' => 'required|min:8',
        ];

        $this->validate($request, $rules);

        $role->fill($request->only('name', 'description'));
        $role->save();

        return $this->responses($role);
    }
}
