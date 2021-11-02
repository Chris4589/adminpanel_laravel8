<?php

namespace App\Http\Controllers\Rango;

use App\Http\Controllers\Controller;
use App\Models\Rango;
use Illuminate\Http\Request;

class RangoController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt')->only(['index', 'update', 'destroy']);
        $this->middleware('roles')->only(['index', 'update', 'destroy']);
        $this->middleware('user_id')->only(['index', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rangos = Rango::all();
        return $this->responses($rangos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rango  $rango
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rango $rango)
    {
        $rules = [
            'name' => 'required|min:4',
            'description' => 'required|min:8',
            'flags' => 'required|min:4',
        ];
        $this->validate($request, $rules);

        $rango->fill($request->only('name', 'description', 'flags'));

        $rango->save();

        return $this->responses($rango);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rango  $rango
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rango $rango)
    {
        $rango->delete();
        return $this->responses($rango);
    }
}
