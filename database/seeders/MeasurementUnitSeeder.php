<?php

namespace Database\Seeders;

use App\Models\MeasurementUnit;
use Illuminate\Database\Seeder;

class MeasurementUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $measurementUnits = [
            ['name' => 'Grammes', 'symbol' => 'g'],
            ['name' => 'Millilitres', 'symbol' => 'ml'],
            ['name' => 'Pièce', 'symbol' => 'pc'],
        ];

        foreach ($measurementUnits as $measurementUnit) {
            MeasurementUnit::create($measurementUnit);
        }
    }
}
