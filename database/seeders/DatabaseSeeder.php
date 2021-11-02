<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Rango;
use App\Models\Role;
use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('role_user')->truncate();
        DB::table('server_user')->truncate();

        User::truncate();
        Role::truncate();
        Server::truncate();
        Admin::truncate();
        Rango::truncate();

        Role::factory(2)->create();
        User::factory(10)->create()->each(function ($user) {
            /* $role = Role::all()->random(); */
            $user->roles()->attach([1, 2]);
        });
        Rango::factory(2)->create();
 
        Server::factory(5)->create()->each(
            function($server) {
                $user = User::all()->random();
                $server->users()->attach($user);
            }
        );
        
        
        Admin::factory(10)->create();
    }
}
