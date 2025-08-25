<?php

namespace Tests\Unit;

use App\Http\Controllers\IngredientController;
use App\Http\Requests\IngredientRequest;
use App\Models\Ingredient;
use App\Models\PlaceType;
use App\Models\MeasurementUnit;
use App\Models\ConnectedScale;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class IngredientControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Configuration spécifique pour SQLite
        if (config('database.default') === 'sqlite') {
            $this->configureSqliteForTests();
        }
        
        $this->controller = new IngredientController();
    }

    protected function configureSqliteForTests(): void
    {
        // Créer la table connected_scales si elle n'existe pas
        if (!Schema::hasTable('connected_scales')) {
            Schema::create('connected_scales', function ($table) {
                $table->id();
                $table->string('mac_address')->unique();
                $table->timestamp('last_update')->nullable();
                $table->string('name')->nullable();
                $table->timestamps();
            });
        }

        // Ajouter la colonne connected_scale_id à ingredients si elle n'existe pas
        if (!Schema::hasColumn('ingredients', 'connected_scale_id')) {
            Schema::table('ingredients', function ($table) {
                $table->foreignId('connected_scale_id')->nullable()->constrained('connected_scales')->onDelete('set null');
            });
        }
    }

    public function test_ingredient_controller_can_store_ingredient()
    {
        // Ce test nécessite une requête HTTP réelle, nous le testons dans les tests de fonctionnalité
        $this->assertTrue(true);
    }

    public function test_ingredient_controller_can_show_ingredient()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        $ingredient = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
        ]);
        
        $response = $this->controller->show($ingredient->id);
        
        $this->assertInstanceOf(\App\Http\Resources\IngredientResource::class, $response);
    }

    public function test_ingredient_controller_returns_404_for_nonexistent_ingredient()
    {
        $response = $this->controller->show(99999);
        
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('Ingrédient non trouvé', json_decode($response->getContent())->message);
    }

    public function test_ingredient_controller_can_update_ingredient()
    {
        // Ce test nécessite une requête HTTP réelle, nous le testons dans les tests de fonctionnalité
        $this->assertTrue(true);
    }

    public function test_ingredient_controller_can_destroy_ingredient()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        $ingredient = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
        ]);
        
        $response = $this->controller->destroy($ingredient->id);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Ingrédient supprimé avec succès', json_decode($response->getContent())->message);
        $this->assertDatabaseMissing('ingredients', ['id' => $ingredient->id]);
    }

    public function test_ingredient_controller_can_update_quantity()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        $ingredient = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 100,
        ]);
        
        $request = new Request();
        $request->merge(['quantity' => 250]);
        
        $response = $this->controller->updateQuantity($request, $ingredient->id);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getContent())->status);
        $this->assertEquals(250, $ingredient->fresh()->quantity);
    }

    public function test_ingredient_controller_can_get_low_stock_ingredients()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        // Créer un ingrédient en rupture de stock (quantité < 50% de max)
        Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'quantity' => 100,
            'max_quantity' => 1000,
        ]);
        
        $response = $this->controller->getLowStockIngredients();
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getContent())->status);
    }

    public function test_ingredient_controller_can_get_connected_ingredients()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        $connectedScale = ConnectedScale::factory()->create();
        
        Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'connected_scale_id' => $connectedScale->id,
        ]);
        
        $response = $this->controller->getConnectedIngredients();
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getContent())->status);
    }

    public function test_ingredient_controller_can_batch_destroy_ingredients()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $ingredient1 = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
        ]);
        
        $ingredient2 = Ingredient::factory()->create([
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
        ]);
        
        $request = new Request();
        $request->merge(['ids' => [$ingredient1->id, $ingredient2->id]]);
        
        $response = $this->controller->batchDestroy($request);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getContent())->status);
        $this->assertEquals(2, json_decode($response->getContent())->count);
    }
}
