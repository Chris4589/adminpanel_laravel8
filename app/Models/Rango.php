<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rango extends Model
{
    use HasFactory;

    public $timestamps = false;//para no tener timestamps 

    protected $fillable = [
        'fk_user',
        'name',
        'description',
        'flags',
    ];

    protected $hidden = ['pivot'];

    public function admins() {
        $this->hasMany(Admin::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
