<?php

namespace Database\Factories;

use App\Models\Festival;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Festival>
 */
class FestivalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDateTime = fake()->dateTimeBetween('+1 week', '+1 year');

        return [
            'title' => ucfirst(fake()->unique()->words(2, true)).' Festival',
            'start_date_time' => $startDateTime,
            'end_date_time' => (clone $startDateTime)->modify('+'.fake()->numberBetween(1, 3).' days'),
            'genre' => fake()->randomElement(['Techno', 'House', 'Hardstyle', 'Pop', 'Rock', 'Hip-hop', 'Drum & Bass']),
            'description' => fake()->paragraphs(2, true),
            'location_id' => Location::factory(),
        ];
    }
}
