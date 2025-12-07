<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['春', '夏', '秋', '冬'];

        foreach ($names as $name) {
            Season::create(['name' => $name]);
        }
    }
}
