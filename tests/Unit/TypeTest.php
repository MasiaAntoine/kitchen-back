<?php

namespace Tests\Unit;

use App\Models\Type;
use App\Models\Ingredient;
use Tests\TestCase;
use Tests\Traits\ConfigureSqliteDatabase;

class TypeTest extends TestCase
{
    use ConfigureSqliteDatabase;

    public function test_type_can_be_created_with_valid_data()
    {
        $type = Type::create([
            'name' => 'Légumes',
        ]);

        $this->assertInstanceOf(Type::class, $type);
        $this->assertEquals('Légumes', $type->name);
    }

    public function test_type_has_ingredients_relationship()
    {
        $type = Type::create([
            'name' => 'Viandes',
        ]);

        $ingredient1 = Ingredient::factory()->create([
            'type_id' => $type->id,
        ]);

        $ingredient2 = Ingredient::factory()->create([
            'type_id' => $type->id,
        ]);

        $this->assertCount(2, $type->ingredients);
        $this->assertInstanceOf(Ingredient::class, $type->ingredients->first());
        $this->assertTrue($type->ingredients->contains($ingredient1));
        $this->assertTrue($type->ingredients->contains($ingredient2));
    }

    public function test_type_can_have_multiple_ingredients()
    {
        $type = Type::create([
            'name' => 'Épices',
        ]);

        // Créer plusieurs ingrédients du même type
        for ($i = 1; $i <= 5; $i++) {
            Ingredient::factory()->create([
                'type_id' => $type->id,
                'label' => "Épice {$i}",
            ]);
        }

        $this->assertCount(5, $type->ingredients);
        $this->assertEquals('Épice 1', $type->ingredients->first()->label);
        $this->assertEquals('Épice 5', $type->ingredients->last()->label);
    }

    public function test_type_name_is_fillable()
    {
        $type = Type::create([
            'name' => 'Fruits',
        ]);

        $type->update([
            'name' => 'Fruits Secs',
        ]);

        $this->assertEquals('Fruits Secs', $type->fresh()->name);
    }
}
