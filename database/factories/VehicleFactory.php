<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    private array $carNames = ['BMW X3', 'BMW X5', 'BMW Series 3', 'Range Rover', 'Skoda', 'VW'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => "mixed", 'vin' => "string"])]
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement($this->carNames),
            'vin' => Str::random(17),
        ];
    }
}
