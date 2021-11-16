<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TariffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->numberBetween(20, 60),
            'begin_date' => '2021-11-01 00:00:00',
            'end_date' => '2021-11-30 23:59:59'
        ];
    }
}
