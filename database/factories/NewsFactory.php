<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'   => $this->faker->realText(50),
            'user_id' => User::all()->random()->id,
            'content' => $this->faker->paragraph(),
        ];
    }
}
