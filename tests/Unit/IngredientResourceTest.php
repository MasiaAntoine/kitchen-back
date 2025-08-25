<?php

namespace Tests\Unit;

use App\Http\Resources\IngredientResource;
use App\Models\Ingredient;
use App\Models\PlaceType;
use App\Models\MeasurementUnit;
use Tests\TestCase;
use Tests\Traits\ConfigureSqliteDatabase;
use Illuminate\Http\Request;

class IngredientResourceTest extends TestCase
{
    use ConfigureSqliteDatabase;

    public function test_ingredient_resource_transforms_ingredient_data()
    {
        $placeType = PlaceType::factory()->create(['name' => 'Légumes']);
        $measurementUnit = MeasurementUnit::factory()->create(['name' => 'Grammes', 'symbol' => 'g']);
        
        $ingredient = Ingredient::factory()->create([
            'label' => 'Tomate',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 500,
            'max_quantity' => 1000,
        ]);

        $resource = new IngredientResource($ingredient);
        $request = Request::create('/');
        $transformed = $resource->toArray($request);

        $this->assertArrayHasKey('id', $transformed);
        $this->assertArrayHasKey('label', $transformed);
        $this->assertArrayHasKey('quantity', $transformed);
        $this->assertArrayHasKey('max_quantity', $transformed);
        $this->assertArrayHasKey('place_type', $transformed);
        $this->assertArrayHasKey('measurement_unit', $transformed);

        $this->assertEquals('Tomate', $transformed['label']);
        $this->assertEquals(500, $transformed['quantity']);
        $this->assertEquals(1000, $transformed['max_quantity']);
    }

    public function test_ingredient_resource_includes_type_information()
    {
        $placeType = PlaceType::factory()->create(['name' => 'Viandes']);
        $measurementUnit = MeasurementUnit::factory()->create(['name' => 'Kilogrammes', 'symbol' => 'kg']);
        
        $ingredient = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
        ]);

        // Charger les relations
        $ingredient->load(['placeType', 'measurementUnit']);

        $resource = new IngredientResource($ingredient);
        $request = Request::create('/');
        $transformed = $resource->toArray($request);

        $this->assertArrayHasKey('place_type', $transformed);
        $this->assertEquals('Viandes', $transformed['place_type']['name']);
    }

    public function test_ingredient_resource_includes_measure_information()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create(['name' => 'Millilitres', 'symbol' => 'ml']);
        
        $ingredient = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
        ]);

        // Charger les relations
        $ingredient->load(['placeType', 'measurementUnit']);

        $resource = new IngredientResource($ingredient);
        $request = Request::create('/');
        $transformed = $resource->toArray($request);

        $this->assertArrayHasKey('measurement_unit', $transformed);
        $this->assertEquals('Millilitres', $transformed['measurement_unit']['name']);
        $this->assertEquals('ml', $transformed['measurement_unit']['symbol']);
    }

    public function test_ingredient_resource_collection_works_correctly()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $ingredient1 = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'label' => 'Ingrédient 1',
        ]);
        
        $ingredient2 = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'label' => 'Ingrédient 2',
        ]);

        $collection = IngredientResource::collection([$ingredient1, $ingredient2]);
        $request = Request::create('/');
        $transformed = $collection->toArray($request);

        $this->assertCount(2, $transformed);
        $this->assertEquals('Ingrédient 1', $transformed[0]['label']);
        $this->assertEquals('Ingrédient 2', $transformed[1]['label']);
    }

    public function test_ingredient_resource_handles_null_connected_scale_id()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $ingredient = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'connected_scale_id' => null,
        ]);

        $resource = new IngredientResource($ingredient);
        $request = Request::create('/');
        $transformed = $resource->toArray($request);

        $this->assertArrayHasKey('connected_scale_id', $transformed);
        $this->assertNull($transformed['connected_scale_id']);
    }

    public function test_ingredient_resource_handles_connected_scale_id()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        $connectedScale = \App\Models\ConnectedScale::factory()->create();
        
        $ingredient = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'connected_scale_id' => $connectedScale->id,
        ]);

        $resource = new IngredientResource($ingredient);
        $request = Request::create('/');
        $transformed = $resource->toArray($request);

        $this->assertArrayHasKey('connected_scale_id', $transformed);
        $this->assertEquals($connectedScale->id, $transformed['connected_scale_id']);
    }
}
