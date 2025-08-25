<?php

namespace Tests\Unit;

use App\Models\PlaceType;
use App\Models\Ingredient;
use Tests\TestCase;
use Tests\Traits\ConfigureSqliteDatabase;

class PlaceTypeTest extends TestCase
{
    use ConfigureSqliteDatabase;

    public function test_place_type_can_be_created_with_valid_data()
    {
        $placeType = PlaceType::create([
            'name' => 'Placard',
        ]);

        $this->assertInstanceOf(PlaceType::class, $placeType);
        $this->assertEquals('Placard', $placeType->name);
    }

    public function test_place_type_has_ingredients_relationship()
    {
        $placeType = PlaceType::create([
            'name' => 'Frigo',
        ]);

        $ingredient1 = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
        ]);

        $ingredient2 = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
        ]);

        $this->assertCount(2, $placeType->ingredients);
        $this->assertInstanceOf(Ingredient::class, $placeType->ingredients->first());
        $this->assertTrue($placeType->ingredients->contains($ingredient1));
        $this->assertTrue($placeType->ingredients->contains($ingredient2));
    }

    public function test_place_type_can_have_multiple_ingredients()
    {
        $placeType = PlaceType::create([
            'name' => 'Congélateur',
        ]);

        // Créer plusieurs ingrédients du même type de lieu
        for ($i = 1; $i <= 5; $i++) {
            Ingredient::factory()->create([
                'place_type_id' => $placeType->id,
                'label' => "Ingrédient {$i}",
            ]);
        }

        $this->assertCount(5, $placeType->ingredients);
        $this->assertEquals('Ingrédient 1', $placeType->ingredients->first()->label);
        $this->assertEquals('Ingrédient 5', $placeType->ingredients->last()->label);
    }

    public function test_place_type_name_is_fillable()
    {
        $placeType = PlaceType::create([
            'name' => 'Étagère',
        ]);

        $placeType->update([
            'name' => 'Armoire',
        ]);

        $this->assertEquals('Armoire', $placeType->fresh()->name);
    }
}
