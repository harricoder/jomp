<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * @var array List of example tags to randomly select from.
     */
    public const EXAMPLE_TAGS = [
        'Drums',
        'Beats',
        'Guitar',
        'Bass',
        'Piano',
        'Keys',
        'Synth',
        'Effects',
        'Reverb',
        'Delay',
        'Phaser',
        'Flanger',
        'EQ',
        'Strings',
        'Brass',
        'Wood Winds',
        'Percussion',
        'Choir',
        'Ethnic',
        'Sound Design',
        'Distortion',
        'Vocal',
        'Mixing',
        'Mastering',
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(self::EXAMPLE_TAGS),
        ];
    }
}
