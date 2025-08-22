<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'Légumes', 'Viandes', 'Poissons', 'Fruits', 'Épices', 
            'Céréales', 'Laitages', 'Boissons', 'Condiments', 'Fruits secs'
        ];

        return [
            'name' => fake()->randomElement($types),
        ];
    }
}
