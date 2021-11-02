<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServerRangoAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Auth\LoginFacebook;
use App\Http\Controllers\Rango\RangoController;
use App\Http\Controllers\Rango\UserRangoController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Server\ServerController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('users', UserController::class, ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('users/auth', AuthController::class, ['only' => ['store']]);
Route::resource('users/auth/fb', LoginFacebook::class, ['only' => ['store']]);
Route::resource('server', ServerController::class, ['only' => ['store', 'index', 'show', 'update', 'destroy']]);
Route::resource('roles', RoleController::class, ['except' => ['edit', 'create', 'destroy', 'store']]);
Route::resource('users.rangos', UserRangoController::class, ['only' => ['store', 'index']]);
Route::resource('rangos', RangoController::class, ['only' => ['index', 'update', 'destroy']]);
Route::resource('server.rango.admin', ServerRangoAdminController::class, ['only' => ['store']]);
Route::resource('admins', AdminController::class, ['only' => ['update', 'destroy']]);
Route::resource('user.server.admin', UserAdminController::class, ['only' => ['index']]);