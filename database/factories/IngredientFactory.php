<?php

namespace Database\Factories;

use App\Models\PlaceType;
use App\Models\MeasurementUnit;
use App\Models\ConnectedScale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => fake()->words(2, true),
            'place_type_id' => PlaceType::factory(),
            'measurement_unit_id' => MeasurementUnit::factory(),
            'connected_scale_id' => null,
            'quantity' => fake()->randomFloat(2, 0, 1000),
            'max_quantity' => fake()->randomFloat(2, 100, 2000),
        ];
    }

    /**
     * Indicate that the ingredient is connected to a balance.
     */
    public function connected(): static
    {
        return $this->state(fn (array $attributes) => [
            'connected_scale_id' => ConnectedScale::factory(),
        ]);
    }

    /**
     * Indicate that the ingredient has low stock.
     */
    public function lowStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'quantity' => fake()->randomFloat(2, 0, 100),
            'max_quantity' => fake()->randomFloat(2, 500, 1000),
        ]);
    }
}
