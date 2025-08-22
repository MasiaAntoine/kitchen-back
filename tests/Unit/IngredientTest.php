<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Measure;
use App\Models\Balance;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientTest extends TestCase
{
    use RefreshDatabase;

    public function test_ingredient_can_be_created_with_valid_data()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Tomate',
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'quantity' => 500,
            'max_quantity' => 1000,
        ]);

        $this->assertInstanceOf(Ingredient::class, $ingredient);
        $this->assertEquals('Tomate', $ingredient->label);
        $this->assertEquals(500, $ingredient->quantity);
        $this->assertEquals(1000, $ingredient->max_quantity);
    }

    public function test_ingredient_has_type_relationship()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Poulet',
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'quantity' => 1000,
            'max_quantity' => 2000,
        ]);

        $this->assertInstanceOf(Type::class, $ingredient->type);
        $this->assertEquals($type->id, $ingredient->type->id);
    }

    public function test_ingredient_has_measure_relationship()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Farine',
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'quantity' => 800,
            'max_quantity' => 1500,
        ]);

        $this->assertInstanceOf(Measure::class, $ingredient->measure);
        $this->assertEquals($measure->id, $ingredient->measure->id);
    }

    public function test_ingredient_has_balance_relationship()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        $balance = Balance::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Lait',
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'balance_id' => $balance->id,
            'quantity' => 600,
            'max_quantity' => 1000,
        ]);

        $this->assertInstanceOf(Balance::class, $ingredient->balance);
        $this->assertEquals($balance->id, $ingredient->balance->id);
    }

    public function test_is_connected_attribute_returns_true_when_balance_id_exists()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        $balance = Balance::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Oeufs',
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'balance_id' => $balance->id,
            'quantity' => 12,
            'max_quantity' => 24,
        ]);

        $this->assertTrue($ingredient->is_connected);
    }

    public function test_is_connected_attribute_returns_false_when_balance_id_is_null()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Sel',
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'quantity' => 100,
            'max_quantity' => 500,
        ]);

        $this->assertFalse($ingredient->is_connected);
    }

    public function test_ingredient_quantity_is_casted_to_float()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Sucre',
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'quantity' => 250.5,
            'max_quantity' => 1000.0,
        ]);

        $this->assertIsFloat($ingredient->quantity);
        $this->assertIsFloat($ingredient->max_quantity);
        $this->assertEquals(250.5, $ingredient->quantity);
    }
}
