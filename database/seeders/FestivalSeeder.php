<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Festival;
use Illuminate\Database\Seeder;

class FestivalSeeder extends Seeder
{
    /**
     * Seed festivals, each with its own location and 3 linked artists.
     */
    public function run(): void
    {
        Festival::factory()
            ->count(5)
            ->hasAttached(Artist::factory()->count(3))
            ->create();
    }
}
