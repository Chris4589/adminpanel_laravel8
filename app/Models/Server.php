<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    public $timestamps = false;//para no tener timestamps

    protected $fillable = [
        'name',
        'foto',
        'description',
        'ip',
    ];

    protected $hidden = ['pivot'];

    public function admins() {
        return $this->hasMany(Admin::class, 'fk_server');
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
