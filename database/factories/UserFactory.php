<?php

namespace Database\Factories;

use App\Models\Vehicle;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape([
        'first_name' => "string",
        'last_name' => "string",
        'vehicle_id' => VehicleFactory::class
    ])] public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'vehicle_id' => Vehicle::factory(),
        ];
    }
}
