<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manufacturer>
 */
class ManufacturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // TODO: Create a more plugin-centric manufacturer list.
        return [
            'name' => $this->faker->unique()->company(),
            'url' => $this->faker->url(),
            'description' => $this->faker->realTextBetween(100, 200),
        ];
    }
}
