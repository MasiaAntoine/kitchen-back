<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MeasurementUnit>
 */
class MeasurementUnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $measurementUnits = [
            ['name' => 'Grammes', 'symbol' => 'g'],
            ['name' => 'Kilogrammes', 'symbol' => 'kg'],
            ['name' => 'Millilitres', 'symbol' => 'ml'],
            ['name' => 'Litres', 'symbol' => 'L'],
            ['name' => 'Pièces', 'symbol' => 'pcs'],
            ['name' => 'Cuillères à soupe', 'symbol' => 'c. à s.'],
            ['name' => 'Cuillères à café', 'symbol' => 'c. à c.'],
        ];

        $measurementUnit = fake()->randomElement($measurementUnits);

        return [
            'name' => $measurementUnit['name'],
            'symbol' => $measurementUnit['symbol'],
        ];
    }
}
