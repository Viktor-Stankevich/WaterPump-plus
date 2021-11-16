<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fio' => $this->faker->name(),
            'area' => $this->faker->randomFloat(2, 100, 150),
            'start_date' => $this->faker->dateTime()
        ];
    }
}
