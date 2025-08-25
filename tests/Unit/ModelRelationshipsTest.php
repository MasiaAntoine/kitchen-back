<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\PlaceType;
use App\Models\MeasurementUnit;
use App\Models\ConnectedScale;
use App\Models\User;
use Tests\TestCase;
use Tests\Traits\ConfigureSqliteDatabase;

class ModelRelationshipsTest extends TestCase
{
    use ConfigureSqliteDatabase;

    public function test_type_has_many_ingredients_relationship()
    {
        $placeType = PlaceType::create(['name' => 'Légumes']);
        
        $ingredient1 = Ingredient::factory()->create(['place_type_id' => $placeType->id]);
        $ingredient2 = Ingredient::factory()->create(['place_type_id' => $placeType->id]);
        $ingredient3 = Ingredient::factory()->create(['place_type_id' => $placeType->id]);

        $this->assertCount(3, $placeType->ingredients);
        $this->assertInstanceOf(Ingredient::class, $placeType->ingredients->first());
        $this->assertTrue($placeType->ingredients->contains($ingredient1));
        $this->assertTrue($placeType->ingredients->contains($ingredient2));
        $this->assertTrue($placeType->ingredients->contains($ingredient3));
    }

    public function test_measure_has_many_ingredients_relationship()
    {
        $measurementUnit = MeasurementUnit::create(['name' => 'Grammes', 'symbol' => 'g']);
        
        $ingredient1 = Ingredient::factory()->create(['measurement_unit_id' => $measurementUnit->id]);
        $ingredient2 = Ingredient::factory()->create(['measurement_unit_id' => $measurementUnit->id]);

        $this->assertCount(2, $measurementUnit->ingredients);
        $this->assertInstanceOf(Ingredient::class, $measurementUnit->ingredients->first());
        $this->assertTrue($measurementUnit->ingredients->contains($ingredient1));
        $this->assertTrue($measurementUnit->ingredients->contains($ingredient2));
    }

    public function test_connected_scale_has_one_ingredient_relationship()
    {
        $connectedScale = ConnectedScale::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Test',
            'last_update' => now(),
        ]);

        $ingredient = Ingredient::factory()->create(['connected_scale_id' => $connectedScale->id]);

        $this->assertInstanceOf(Ingredient::class, $connectedScale->ingredient);
        $this->assertEquals($ingredient->id, $connectedScale->ingredient->id);
    }

    public function test_ingredient_belongs_to_type_relationship()
    {
        $placeType = PlaceType::create(['name' => 'Viandes']);
        $ingredient = Ingredient::factory()->create(['place_type_id' => $placeType->id]);

        $this->assertInstanceOf(PlaceType::class, $ingredient->placeType);
        $this->assertEquals($placeType->id, $ingredient->placeType->id);
        $this->assertEquals('Viandes', $ingredient->placeType->name);
    }

    public function test_ingredient_belongs_to_measure_relationship()
    {
        $measurementUnit = MeasurementUnit::create(['name' => 'Kilogrammes', 'symbol' => 'kg']);
        $ingredient = Ingredient::factory()->create(['measurement_unit_id' => $measurementUnit->id]);

        $this->assertInstanceOf(MeasurementUnit::class, $ingredient->measurementUnit);
        $this->assertEquals($measurementUnit->id, $ingredient->measurementUnit->id);
        $this->assertEquals('Kilogrammes', $ingredient->measurementUnit->name);
    }

    public function test_ingredient_belongs_to_connected_scale_relationship()
    {
        $connectedScale = ConnectedScale::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Test',
            'last_update' => now(),
        ]);
        
        $ingredient = Ingredient::factory()->create(['connected_scale_id' => $connectedScale->id]);

        $this->assertInstanceOf(ConnectedScale::class, $ingredient->connectedScale);
        $this->assertEquals($connectedScale->id, $ingredient->connectedScale->id);
        $this->assertEquals('AA:BB:CC:DD:EE:FF', $ingredient->connectedScale->mac_address);
    }

    public function test_cascade_relationships_work_correctly()
    {
        // Créer un type avec plusieurs ingrédients
        $placeType = PlaceType::create(['name' => 'Épices']);
        $measurementUnit = MeasurementUnit::create(['name' => 'Grammes', 'symbol' => 'g']);
        
        $ingredient1 = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'label' => 'Poivre',
        ]);
        
        $ingredient2 = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'label' => 'Sel',
        ]);

        // Vérifier que le type a bien les deux ingrédients
        $this->assertCount(2, $placeType->ingredients);
        $this->assertTrue($placeType->ingredients->contains($ingredient1));
        $this->assertTrue($placeType->ingredients->contains($ingredient2));

        // Vérifier que la mesure a bien les deux ingrédients
        $this->assertCount(2, $measurementUnit->ingredients);
        $this->assertTrue($measurementUnit->ingredients->contains($ingredient1));
        $this->assertTrue($measurementUnit->ingredients->contains($ingredient2));

        // Vérifier que chaque ingrédient pointe vers le bon type de lieu et la bonne unité de mesure
        $this->assertEquals($placeType->id, $ingredient1->placeType->id);
        $this->assertEquals($measurementUnit->id, $ingredient1->measurementUnit->id);
        $this->assertEquals($placeType->id, $ingredient2->placeType->id);
        $this->assertEquals($measurementUnit->id, $ingredient2->measurementUnit->id);
    }

    public function test_ingredient_without_connected_scale_has_null_connected_scale_relationship()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $ingredient = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'connected_scale_id' => null,
        ]);

        $this->assertNull($ingredient->connectedScale);
        $this->assertFalse($ingredient->is_connected);
    }

    public function test_ingredient_with_connected_scale_has_valid_connected_scale_relationship()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        $connectedScale = ConnectedScale::factory()->create();
        
        $ingredient = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'connected_scale_id' => $connectedScale->id,
        ]);

        $this->assertNotNull($ingredient->connectedScale);
        $this->assertInstanceOf(ConnectedScale::class, $ingredient->connectedScale);
        $this->assertTrue($ingredient->is_connected);
    }
}
