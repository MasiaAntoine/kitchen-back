<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlaceType>
 */
class PlaceTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $placeTypes = [
            'Placard', 'Frigo', 'Congélateur', 'Cave', 'Étagère', 
            'Tiroir', 'Comptoir', 'Armoire', 'Cellier', 'Réserve'
        ];

        return [
            'name' => fake()->randomElement($placeTypes),
        ];
    }
}
