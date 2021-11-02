<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt')->only(['index']);
        $this->middleware('roles')->only(['index']);
        $this->middleware('user_id')->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Server $server)
    {
        $admin = $user
                ->servers()
                ->where('id', $server->id)
                ->first()
                ->admins()
                ->get();

        return $this->responses($admin);
    }
}
