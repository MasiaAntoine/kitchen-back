<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Measure;
use App\Models\ConnectedScale;
use App\Models\User;
use Tests\TestCase;
use Tests\Traits\ConfigureSqliteDatabase;

class ModelRelationshipsTest extends TestCase
{
    use ConfigureSqliteDatabase;

    public function test_type_has_many_ingredients_relationship()
    {
        $type = Type::create(['name' => 'Légumes']);
        
        $ingredient1 = Ingredient::factory()->create(['type_id' => $type->id]);
        $ingredient2 = Ingredient::factory()->create(['type_id' => $type->id]);
        $ingredient3 = Ingredient::factory()->create(['type_id' => $type->id]);

        $this->assertCount(3, $type->ingredients);
        $this->assertInstanceOf(Ingredient::class, $type->ingredients->first());
        $this->assertTrue($type->ingredients->contains($ingredient1));
        $this->assertTrue($type->ingredients->contains($ingredient2));
        $this->assertTrue($type->ingredients->contains($ingredient3));
    }

    public function test_measure_has_many_ingredients_relationship()
    {
        $measure = Measure::create(['name' => 'Grammes', 'symbol' => 'g']);
        
        $ingredient1 = Ingredient::factory()->create(['measure_id' => $measure->id]);
        $ingredient2 = Ingredient::factory()->create(['measure_id' => $measure->id]);

        $this->assertCount(2, $measure->ingredients);
        $this->assertInstanceOf(Ingredient::class, $measure->ingredients->first());
        $this->assertTrue($measure->ingredients->contains($ingredient1));
        $this->assertTrue($measure->ingredients->contains($ingredient2));
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
        $type = Type::create(['name' => 'Viandes']);
        $ingredient = Ingredient::factory()->create(['type_id' => $type->id]);

        $this->assertInstanceOf(Type::class, $ingredient->type);
        $this->assertEquals($type->id, $ingredient->type->id);
        $this->assertEquals('Viandes', $ingredient->type->name);
    }

    public function test_ingredient_belongs_to_measure_relationship()
    {
        $measure = Measure::create(['name' => 'Kilogrammes', 'symbol' => 'kg']);
        $ingredient = Ingredient::factory()->create(['measure_id' => $measure->id]);

        $this->assertInstanceOf(Measure::class, $ingredient->measure);
        $this->assertEquals($measure->id, $ingredient->measure->id);
        $this->assertEquals('Kilogrammes', $ingredient->measure->name);
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
        $type = Type::create(['name' => 'Épices']);
        $measure = Measure::create(['name' => 'Grammes', 'symbol' => 'g']);
        
        $ingredient1 = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'label' => 'Poivre',
        ]);
        
        $ingredient2 = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'label' => 'Sel',
        ]);

        // Vérifier que le type a bien les deux ingrédients
        $this->assertCount(2, $type->ingredients);
        $this->assertTrue($type->ingredients->contains($ingredient1));
        $this->assertTrue($type->ingredients->contains($ingredient2));

        // Vérifier que la mesure a bien les deux ingrédients
        $this->assertCount(2, $measure->ingredients);
        $this->assertTrue($measure->ingredients->contains($ingredient1));
        $this->assertTrue($measure->ingredients->contains($ingredient2));

        // Vérifier que chaque ingrédient pointe vers le bon type et la bonne mesure
        $this->assertEquals($type->id, $ingredient1->type->id);
        $this->assertEquals($measure->id, $ingredient1->measure->id);
        $this->assertEquals($type->id, $ingredient2->type->id);
        $this->assertEquals($measure->id, $ingredient2->measure->id);
    }

    public function test_ingredient_without_connected_scale_has_null_connected_scale_relationship()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        $ingredient = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'connected_scale_id' => null,
        ]);

        $this->assertNull($ingredient->connectedScale);
        $this->assertFalse($ingredient->is_connected);
    }

    public function test_ingredient_with_connected_scale_has_valid_connected_scale_relationship()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        $connectedScale = ConnectedScale::factory()->create();
        
        $ingredient = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'connected_scale_id' => $connectedScale->id,
        ]);

        $this->assertNotNull($ingredient->connectedScale);
        $this->assertInstanceOf(ConnectedScale::class, $ingredient->connectedScale);
        $this->assertTrue($ingredient->is_connected);
    }
}
