<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['slug' => "string", 'time_in' => "string", 'time_out' => "string"])]
    public function definition(): array
    {
        return [
            'slug' => $this->faker->word(),
            'time_in' => $this->faker->time('H:i', '11:59'),
            'time_out' => $this->faker->time('H:i', '23:59')
        ];
    }
}
