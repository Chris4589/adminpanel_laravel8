<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $rules = [
            'steamid' => 'required|min:2',
            'name' => 'required|min:2',
            'type' => 'required|integer|min:1',
            'password' => 'required|min:4',
            'date' => 'required|date',
        ];

        $this->validate($request, $rules);

        $admin = $admin->fill($request->only('steamid', 'name', 'type', 'password', 'date'));
        $admin->save();
        return $this->responses($admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return $this->responses($admin);
    }
}
