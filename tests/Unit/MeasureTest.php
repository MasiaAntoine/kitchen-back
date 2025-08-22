<?php

namespace Tests\Unit;

use App\Models\Measure;
use App\Models\Ingredient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeasureTest extends TestCase
{
    use RefreshDatabase;

    public function test_measure_can_be_created_with_valid_data()
    {
        $measure = Measure::create([
            'name' => 'Grammes',
            'symbol' => 'g',
        ]);

        $this->assertInstanceOf(Measure::class, $measure);
        $this->assertEquals('Grammes', $measure->name);
        $this->assertEquals('g', $measure->symbol);
    }

    public function test_measure_has_ingredients_relationship()
    {
        $measure = Measure::create([
            'name' => 'Millilitres',
            'symbol' => 'ml',
        ]);

        $ingredient1 = Ingredient::factory()->create([
            'measure_id' => $measure->id,
        ]);

        $ingredient2 = Ingredient::factory()->create([
            'measure_id' => $measure->id,
        ]);

        $this->assertCount(2, $measure->ingredients);
        $this->assertInstanceOf(Ingredient::class, $measure->ingredients->first());
        $this->assertTrue($measure->ingredients->contains($ingredient1));
        $this->assertTrue($measure->ingredients->contains($ingredient2));
    }

    public function test_measure_can_have_multiple_ingredients()
    {
        $measure = Measure::create([
            'name' => 'Kilogrammes',
            'symbol' => 'kg',
        ]);

        // Créer plusieurs ingrédients avec la même mesure
        for ($i = 1; $i <= 3; $i++) {
            Ingredient::factory()->create([
                'measure_id' => $measure->id,
                'label' => "Ingrédient {$i}",
            ]);
        }

        $this->assertCount(3, $measure->ingredients);
        $this->assertEquals('Ingrédient 1', $measure->ingredients->first()->label);
        $this->assertEquals('Ingrédient 3', $measure->ingredients->last()->label);
    }

    public function test_measure_name_and_symbol_are_fillable()
    {
        $measure = Measure::create([
            'name' => 'Pouces',
            'symbol' => 'po',
        ]);

        $measure->update([
            'name' => 'Centimètres',
            'symbol' => 'cm',
        ]);

        $this->assertEquals('Centimètres', $measure->fresh()->name);
        $this->assertEquals('cm', $measure->fresh()->symbol);
    }
}
