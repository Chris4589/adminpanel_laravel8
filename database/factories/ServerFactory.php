<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'foto' => 'https://i.imgur.com/fnWHQPW.png',
            'description' => $this->faker->paragraph(1),
            'ip' => '127.0.0.1',
        ];

    }
}
