<?php

namespace App\Models;

use App\Models\Rango;
use App\Models\Server;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public $timestamps = false;//para no tener timestamps

    protected $fillable = [
        'fk_server',
        'fk_rango',
        'steamid',
        'name',
        'type',
        'password',
        'date',
    ];

    protected $hidden = ['pivot'];

    public function rango() {
        return $this->belongsTo(Rango::class, 'fk_rango');
    }

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
