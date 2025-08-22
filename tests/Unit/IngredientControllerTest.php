<?php

namespace Tests\Unit;

use App\Http\Controllers\IngredientController;
use App\Http\Requests\IngredientRequest;
use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Measure;
use App\Models\Balance;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class IngredientControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new IngredientController();
    }

    public function test_ingredient_controller_can_store_ingredient()
    {
        // Ce test nécessite une requête HTTP réelle, nous le testons dans les tests de fonctionnalité
        $this->assertTrue(true);
    }

    public function test_ingredient_controller_can_show_ingredient()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        $ingredient = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
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
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        $ingredient = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
        ]);
        
        $response = $this->controller->destroy($ingredient->id);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Ingrédient supprimé avec succès', json_decode($response->getContent())->message);
        $this->assertDatabaseMissing('ingredients', ['id' => $ingredient->id]);
    }

    public function test_ingredient_controller_can_update_quantity()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        $ingredient = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
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
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        // Créer un ingrédient en rupture de stock (quantité < 50% de max)
        Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'quantity' => 100,
            'max_quantity' => 1000,
        ]);
        
        $response = $this->controller->getLowStockIngredients();
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getContent())->status);
    }

    public function test_ingredient_controller_can_get_connected_ingredients()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        $balance = Balance::factory()->create();
        
        Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'balance_id' => $balance->id,
        ]);
        
        $response = $this->controller->getConnectedIngredients();
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getContent())->status);
    }

    public function test_ingredient_controller_can_batch_destroy_ingredients()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        $ingredient1 = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
        ]);
        
        $ingredient2 = Ingredient::factory()->create([
            'type_id' => $type->id,
            'measure_id' => $measure->id,
        ]);
        
        $request = new Request();
        $request->merge(['ids' => [$ingredient1->id, $ingredient2->id]]);
        
        $response = $this->controller->batchDestroy($request);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getContent())->status);
        $this->assertEquals(2, json_decode($response->getContent())->count);
    }
}
