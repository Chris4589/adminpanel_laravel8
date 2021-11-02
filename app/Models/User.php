<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    const USER_ROLE = 'ADMIN_ROLE';

    public $timestamps = false;//para no tener timestamps

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['pivot'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    /* protected $casts = [
        'email_verified_at' => 'datetime',
    ]; */

    public function servers() {
        return $this->belongsToMany(Server::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function rangos() {
        return $this->hasMany(Rango::class, 'fk_user');
    }
}
