<?php

namespace Tests\Unit;

use App\Http\Resources\IngredientResource;
use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Measure;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class IngredientResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_ingredient_resource_transforms_ingredient_data()
    {
        $type = Type::factory()->create(['name' => 'Légumes']);
        $measure = Measure::factory()->create(['name' => 'Grammes', 'symbol' => 'g']);
        
        $ingredient = Ingredient::factory()->create([
            'label' => 'Tomate',
            'type_id' => $type->id,
            'measure_id' => $measure->id,
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
        $this->assertArrayHasKey('type', $transformed);
        $this->assertArrayHasKey('measure', $transformed);

        $this->assertEquals('Tomate', $transformed['label']);
        $this->assertEquals(500, $transformed['quantity']);
        $this->assertEquals(1000, $transformed['max_quantity']);
    }

    public function test_ingredient_resource_includes_type_information()
    {
        $type = Type::factory()->create(['name' => 'Viandes']);
        $measure = Measure::factory()->create(['name' => 'Kilogrammes', 'symbol' => 'kg']);
        
        $ingredient = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
        ]);

        // Charger les relations
        $ingredient->load(['type', 'measure']);

        $resource = new IngredientResource($ingredient);
        $request = Request::create('/');
        $transformed = $resource->toArray($request);

        $this->assertArrayHasKey('type', $transformed);
        $this->assertEquals('Viandes', $transformed['type']['name']);
    }

    public function test_ingredient_resource_includes_measure_information()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create(['name' => 'Millilitres', 'symbol' => 'ml']);
        
        $ingredient = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
        ]);

        // Charger les relations
        $ingredient->load(['type', 'measure']);

        $resource = new IngredientResource($ingredient);
        $request = Request::create('/');
        $transformed = $resource->toArray($request);

        $this->assertArrayHasKey('measure', $transformed);
        $this->assertEquals('Millilitres', $transformed['measure']['name']);
        $this->assertEquals('ml', $transformed['measure']['symbol']);
    }

    public function test_ingredient_resource_collection_works_correctly()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        $ingredient1 = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'label' => 'Ingrédient 1',
        ]);
        
        $ingredient2 = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'label' => 'Ingrédient 2',
        ]);

        $collection = IngredientResource::collection([$ingredient1, $ingredient2]);
        $request = Request::create('/');
        $transformed = $collection->toArray($request);

        $this->assertCount(2, $transformed);
        $this->assertEquals('Ingrédient 1', $transformed[0]['label']);
        $this->assertEquals('Ingrédient 2', $transformed[1]['label']);
    }

    public function test_ingredient_resource_handles_null_balance_id()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        $ingredient = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'balance_id' => null,
        ]);

        $resource = new IngredientResource($ingredient);
        $request = Request::create('/');
        $transformed = $resource->toArray($request);

        $this->assertArrayHasKey('balance_id', $transformed);
        $this->assertNull($transformed['balance_id']);
    }

    public function test_ingredient_resource_handles_balance_id()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        $balance = \App\Models\Balance::factory()->create();
        
        $ingredient = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'balance_id' => $balance->id,
        ]);

        $resource = new IngredientResource($ingredient);
        $request = Request::create('/');
        $transformed = $resource->toArray($request);

        $this->assertArrayHasKey('balance_id', $transformed);
        $this->assertEquals($balance->id, $transformed['balance_id']);
    }
}
