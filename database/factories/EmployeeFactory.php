<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape([
        'name' => "string",
        'position' => "string",
        'email' => "string",
        'pin_code' => "string",
        'email_verified_at' => "\Illuminate\Support\Carbon",
        'remember_token' => "string"
    ])]
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'position' => $this->faker->title(),
            'email' => $this->faker->unique()->companyEmail(),
            'pin_code' => bcrypt('1234'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}
