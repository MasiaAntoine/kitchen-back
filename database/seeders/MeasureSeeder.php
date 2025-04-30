<?php

namespace Database\Seeders;

use App\Models\Measure;
use Illuminate\Database\Seeder;

class MeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $measures = [
            ['name' => 'Grammes', 'symbol' => 'g'],
            ['name' => 'Millilitres', 'symbol' => 'ml'],
            ['name' => 'Pièce', 'symbol' => 'pc'],
        ];

        foreach ($measures as $measure) {
            Measure::create($measure);
        }
    }
}
