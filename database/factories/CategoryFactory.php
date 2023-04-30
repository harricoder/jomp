<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * @var array List of example categories to randomly select from.
     */
    public const EXAMPLE_CATEGORIES = [
        'Drums and Beats',
        'Guitar',
        'Bass',
        'Piano and Keys',
        'Synth',
        'Effects',
        'Orchestral',
        'Vocal',
        'Mixing',
        'Mastering',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(self::EXAMPLE_CATEGORIES),
        ];
    }
}
