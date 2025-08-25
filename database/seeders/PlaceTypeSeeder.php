<?php

namespace Database\Seeders;

use App\Models\PlaceType;
use Illuminate\Database\Seeder;

class PlaceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $placeTypes = [
            ['name' => 'Placard'],
            ['name' => 'Frigo'],
            ['name' => 'Congélateur'],
        ];

        foreach ($placeTypes as $placeType) {
            PlaceType::create($placeType);
        }
    }
}
