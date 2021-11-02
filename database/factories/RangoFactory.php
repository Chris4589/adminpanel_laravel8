<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RangoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->random();

        return [
            'fk_user' => $user->id,
            'name' => '[ OWNER ]',
            'description' => $this->faker->paragraph(2),
        ];
    }
}
