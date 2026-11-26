<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->name();
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'genre' => fake()->randomElement(['Techno', 'House', 'Hardstyle', 'Pop', 'Rock', 'Hip-hop', 'Drum & Bass']),
            'spotify_url' => 'https://open.spotify.com/artist/'.Str::random(22),
            'soundcloud_url' => 'https://soundcloud.com/'.$slug,
        ];
    }
}
