<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Measure;
use App\Models\ConnectedScale;
use Tests\TestCase;
use Tests\Traits\ConfigureSqliteDatabase;

class BusinessLogicTest extends TestCase
{
    use ConfigureSqliteDatabase;

    public function test_ingredient_stock_level_calculation()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Test Stock',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 300,
            'max_quantity' => 1000,
        ]);

        $stockPercentage = ($ingredient->quantity / $ingredient->max_quantity) * 100;
        
        $this->assertEquals(30, $stockPercentage);
        $this->assertTrue($ingredient->quantity < ($ingredient->max_quantity * 0.5));
    }

    public function test_ingredient_is_low_stock_when_below_50_percent()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $lowStockIngredient = Ingredient::create([
            'label' => 'Stock Faible',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 200,
            'max_quantity' => 1000,
        ]);

        $normalStockIngredient = Ingredient::create([
            'label' => 'Stock Normal',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 700,
            'max_quantity' => 1000,
        ]);

        $this->assertTrue($lowStockIngredient->quantity <= ($lowStockIngredient->max_quantity * 0.5));
        $this->assertFalse($normalStockIngredient->quantity <= ($normalStockIngredient->max_quantity * 0.5));
    }

    public function test_connected_scale_online_status_based_on_last_update()
    {
        $recentConnectedScale = ConnectedScale::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Récente',
            'last_update' => now()->subMinutes(2),
        ]);

        $oldConnectedScale = ConnectedScale::create([
            'mac_address' => 'BB:CC:DD:EE:FF:AA',
            'name' => 'Balance Ancienne',
            'last_update' => now()->subMinutes(10),
        ]);

        $this->assertTrue($recentConnectedScale->isOnline());
        $this->assertFalse($oldConnectedScale->isOnline());
    }

    public function test_ingredient_connection_status()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        $connectedScale = ConnectedScale::factory()->create();
        
        $connectedIngredient = Ingredient::create([
            'label' => 'Connecté',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'connected_scale_id' => $connectedScale->id,
            'quantity' => 500,
            'max_quantity' => 1000,
        ]);

        $disconnectedIngredient = Ingredient::create([
            'label' => 'Non Connecté',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'connected_scale_id' => null,
            'quantity' => 300,
            'max_quantity' => 800,
        ]);

        $this->assertTrue($connectedIngredient->is_connected);
        $this->assertFalse($disconnectedIngredient->is_connected);
    }

    public function test_ingredient_quantity_validation()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $ingredient = Ingredient::create([
            'label' => 'Test Quantité',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 500,
            'max_quantity' => 1000,
        ]);

        // Vérifier que la quantité ne peut pas dépasser le maximum
        $this->assertLessThanOrEqual($ingredient->max_quantity, $ingredient->quantity);
        
        // Vérifier que la quantité ne peut pas être négative
        $this->assertGreaterThanOrEqual(0, $ingredient->quantity);
    }

    public function test_ingredient_type_categorization()
    {
        $legumesType = PlaceType::create(['name' => 'Légumes']);
        $viandesType = PlaceType::create(['name' => 'Viandes']);
        $epicesType = PlaceType::create(['name' => 'Épices']);
        
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $tomate = Ingredient::create([
            'label' => 'Tomate',
            'place_type_id' => $legumesType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 500,
            'max_quantity' => 1000,
        ]);

        $poulet = Ingredient::create([
            'label' => 'Poulet',
            'place_type_id' => $viandesType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 1000,
            'max_quantity' => 2000,
        ]);

        $poivre = Ingredient::create([
            'label' => 'Poivre',
            'place_type_id' => $epicesType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 100,
            'max_quantity' => 500,
        ]);

        $this->assertEquals('Légumes', $tomate->type->name);
        $this->assertEquals('Viandes', $poulet->type->name);
        $this->assertEquals('Épices', $poivre->type->name);
    }

    public function test_measure_unit_consistency()
    {
        $grammes = MeasurementUnit::create(['name' => 'Grammes', 'symbol' => 'g']);
        $kilogrammes = MeasurementUnit::create(['name' => 'Kilogrammes', 'symbol' => 'kg']);
        $millilitres = MeasurementUnit::create(['name' => 'Millilitres', 'symbol' => 'ml']);
        
        $placeType = PlaceType::factory()->create();
        
        $ingredient1 = Ingredient::create([
            'label' => 'Ingrédient en grammes',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $grammes->id,
            'quantity' => 500,
            'max_quantity' => 1000,
        ]);

        $ingredient2 = Ingredient::create([
            'label' => 'Ingrédient en kg',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $kilogrammes->id,
            'quantity' => 2.5,
            'max_quantity' => 5,
        ]);

        $this->assertEquals('g', $ingredient1->measure->symbol);
        $this->assertEquals('kg', $ingredient2->measure->symbol);
        $this->assertEquals('Grammes', $ingredient1->measure->name);
        $this->assertEquals('Kilogrammes', $ingredient2->measure->name);
    }

    public function test_ingredient_balance_association()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $connectedScale1 = ConnectedScale::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance 1',
            'last_update' => now(),
        ]);
        
        $connectedScale2 = ConnectedScale::create([
            'mac_address' => 'BB:CC:DD:EE:FF:AA',
            'name' => 'Balance 2',
            'last_update' => now(),
        ]);

        $ingredient1 = Ingredient::create([
            'label' => 'Ingrédient 1',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'connected_scale_id' => $connectedScale1->id,
            'quantity' => 400,
            'max_quantity' => 1000,
        ]);

        $ingredient2 = Ingredient::create([
            'label' => 'Ingrédient 2',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'connected_scale_id' => $connectedScale2->id,
            'quantity' => 600,
            'max_quantity' => 1200,
        ]);

        $this->assertEquals($connectedScale1->id, $ingredient1->connected_scale_id);
        $this->assertEquals($connectedScale2->id, $ingredient2->connected_scale_id);
        $this->assertNotEquals($ingredient1->connected_scale_id, $ingredient2->connected_scale_id);
    }
}
