<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\PlaceType;
use App\Models\MeasurementUnit;
use App\Models\ConnectedScale;
use Tests\TestCase;
use Tests\Traits\ConfigureSqliteDatabase;

class IngredientTest extends TestCase
{
    use ConfigureSqliteDatabase;

    public function test_ingredient_can_be_created_with_valid_data()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Tomate',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
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
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Poulet',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 1000,
            'max_quantity' => 2000,
        ]);

        $this->assertInstanceOf(PlaceType::class, $ingredient->placeType);
        $this->assertEquals($placeType->id, $ingredient->placeType->id);
    }

    public function test_ingredient_has_measure_relationship()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Farine',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 800,
            'max_quantity' => 1500,
        ]);

        $this->assertInstanceOf(MeasurementUnit::class, $ingredient->measurementUnit);
        $this->assertEquals($measurementUnit->id, $ingredient->measurementUnit->id);
    }

    public function test_ingredient_has_connected_scale_relationship()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        $connectedScale = ConnectedScale::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Lait',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'connected_scale_id' => $connectedScale->id,
            'quantity' => 600,
            'max_quantity' => 1000,
        ]);

        $this->assertInstanceOf(ConnectedScale::class, $ingredient->connectedScale);
        $this->assertEquals($connectedScale->id, $ingredient->connectedScale->id);
    }

    public function test_is_connected_attribute_returns_true_when_connected_scale_id_exists()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        $connectedScale = ConnectedScale::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Oeufs',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'connected_scale_id' => $connectedScale->id,
            'quantity' => 12,
            'max_quantity' => 24,
        ]);

        $this->assertTrue($ingredient->is_connected);
    }

    public function test_is_connected_attribute_returns_false_when_balance_id_is_null()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Sel',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 100,
            'max_quantity' => 500,
        ]);

        $this->assertFalse($ingredient->is_connected);
    }

    public function test_ingredient_quantity_is_casted_to_float()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Sucre',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 250.5,
            'max_quantity' => 1000.0,
        ]);

        $this->assertIsFloat($ingredient->quantity);
        $this->assertIsFloat($ingredient->max_quantity);
        $this->assertEquals(250.5, $ingredient->quantity);
    }
}
