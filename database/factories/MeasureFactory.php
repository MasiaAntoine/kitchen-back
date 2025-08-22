<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Measure>
 */
class MeasureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $measures = [
            ['name' => 'Grammes', 'symbol' => 'g'],
            ['name' => 'Kilogrammes', 'symbol' => 'kg'],
            ['name' => 'Millilitres', 'symbol' => 'ml'],
            ['name' => 'Litres', 'symbol' => 'L'],
            ['name' => 'Pièces', 'symbol' => 'pcs'],
            ['name' => 'Cuillères à soupe', 'symbol' => 'c. à s.'],
            ['name' => 'Cuillères à café', 'symbol' => 'c. à c.'],
        ];

        $measure = fake()->randomElement($measures);

        return [
            'name' => $measure['name'],
            'symbol' => $measure['symbol'],
        ];
    }
}
