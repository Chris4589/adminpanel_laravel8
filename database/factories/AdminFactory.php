<?php

namespace Database\Factories;

use App\Models\Rango;
use App\Models\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {
        $server = Server::all()->random();
        $rango = Rango::all()->random();
        
        return [
            'fk_server' => $server->id,
            'fk_rango' => $rango->id,
            'steamid' => 'STEAM_1:0:3243243443',
            'name' => $this->faker->name(),
            'password' => bcrypt($this->faker->word()),
            'date' => $this->faker->date(),
        ];
    }
}
