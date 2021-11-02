<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;//para no tener timestamps

    protected $fillable = [
        'role',
        'name',
        'description',
    ];

    protected $hidden = ['pivot'];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
