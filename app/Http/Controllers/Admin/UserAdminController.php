<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Server;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt')->only(['index']);
        /* $this->middleware('roles')->only(['index']); */
        $this->middleware('user_id')->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user, Server $server)
    {
        $date = intval($request->query('date', 0));
        $per_page = intval($request->per_page, 10);

        if ($date) {
            $hoy = Carbon::today();

            $admin = $user
                ->servers()
                ->where('id', '=', $server->id)
                ->first()
                ->admins()->with(['rango' => function($query){
                    $query->select(['id', 'name', 'flags']);
                }])
                ->where('date', '>=', $hoy)->get();

            return $this->responses($admin);
        }

        $admin = $user
                ->servers()
                ->where('id', $server->id)
                ->first()
                ->admins()
                ->paginate($per_page); 

        return $this->responses($admin);
    }
}
