<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Balance>
 */
class BalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mac_address' => fake()->macAddress(),
            'name' => fake()->words(2, true) . ' Balance',
            'last_update' => fake()->dateTimeBetween('-1 hour', 'now'),
        ];
    }

    /**
     * Indicate that the balance is online (recent update).
     */
    public function online(): static
    {
        return $this->state(fn (array $attributes) => [
            'last_update' => fake()->dateTimeBetween('-4 minutes', 'now'),
        ]);
    }

    /**
     * Indicate that the balance is offline (old update).
     */
    public function offline(): static
    {
        return $this->state(fn (array $attributes) => [
            'last_update' => fake()->dateTimeBetween('-1 day', '-10 minutes'),
        ]);
    }
}
