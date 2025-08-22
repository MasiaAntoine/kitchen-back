<?php

namespace Database\Factories;

use App\Models\Type;
use App\Models\Measure;
use App\Models\Balance;
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
            'type_id' => Type::factory(),
            'measure_id' => Measure::factory(),
            'balance_id' => null,
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
            'balance_id' => Balance::factory(),
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
