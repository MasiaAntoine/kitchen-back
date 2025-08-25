<?php

namespace Tests\Unit;

use App\Models\MeasurementUnit;
use App\Models\Ingredient;
use Tests\TestCase;
use Tests\Traits\ConfigureSqliteDatabase;

class MeasurementUnitTest extends TestCase
{
    use ConfigureSqliteDatabase;

    public function test_measurement_unit_can_be_created_with_valid_data()
    {
        $measurementUnit = MeasurementUnit::create([
            'name' => 'Grammes',
            'symbol' => 'g',
        ]);

        $this->assertInstanceOf(MeasurementUnit::class, $measurementUnit);
        $this->assertEquals('Grammes', $measurementUnit->name);
        $this->assertEquals('g', $measurementUnit->symbol);
    }

    public function test_measurement_unit_has_ingredients_relationship()
    {
        $measurementUnit = MeasurementUnit::create([
            'name' => 'Millilitres',
            'symbol' => 'ml',
        ]);

        $ingredient1 = Ingredient::factory()->create([
            'measurement_unit_id' => $measurementUnit->id,
        ]);

        $ingredient2 = Ingredient::factory()->create([
            'measurement_unit_id' => $measurementUnit->id,
        ]);

        $this->assertCount(2, $measurementUnit->ingredients);
        $this->assertInstanceOf(Ingredient::class, $measurementUnit->ingredients->first());
        $this->assertTrue($measurementUnit->ingredients->contains($ingredient1));
        $this->assertTrue($measurementUnit->ingredients->contains($ingredient2));
    }

    public function test_measurement_unit_can_have_multiple_ingredients()
    {
        $measurementUnit = MeasurementUnit::create([
            'name' => 'Kilogrammes',
            'symbol' => 'kg',
        ]);

        // Créer plusieurs ingrédients avec la même unité de mesure
        for ($i = 1; $i <= 3; $i++) {
            Ingredient::factory()->create([
                'measurement_unit_id' => $measurementUnit->id,
                'label' => "Ingrédient {$i}",
            ]);
        }

        $this->assertCount(3, $measurementUnit->ingredients);
        $this->assertEquals('Ingrédient 1', $measurementUnit->ingredients->first()->label);
        $this->assertEquals('Ingrédient 3', $measurementUnit->ingredients->last()->label);
    }

    public function test_measurement_unit_name_and_symbol_are_fillable()
    {
        $measurementUnit = MeasurementUnit::create([
            'name' => 'Pouces',
            'symbol' => 'po',
        ]);

        $measurementUnit->update([
            'name' => 'Centimètres',
            'symbol' => 'cm',
        ]);

        $this->assertEquals('Centimètres', $measurementUnit->fresh()->name);
        $this->assertEquals('cm', $measurementUnit->fresh()->symbol);
    }
}
