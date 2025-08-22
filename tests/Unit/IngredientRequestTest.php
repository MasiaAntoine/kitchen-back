<?php

namespace Tests\Unit;

use App\Http\Requests\IngredientRequest;
use App\Models\Type;
use App\Models\Measure;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;

class IngredientRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_ingredient_request_authorizes_all_users()
    {
        $request = new IngredientRequest();
        
        $this->assertTrue($request->authorize());
    }

    public function test_ingredient_request_validation_rules()
    {
        $request = new IngredientRequest();
        $rules = $request->rules();
        
        $this->assertArrayHasKey('label', $rules);
        $this->assertArrayHasKey('type_id', $rules);
        $this->assertArrayHasKey('measure_id', $rules);
        $this->assertArrayHasKey('max_quantity', $rules);
        $this->assertArrayHasKey('quantity', $rules);
        $this->assertArrayHasKey('balance_id', $rules);
        
        $this->assertStringContainsString('required', $rules['label']);
        $this->assertStringContainsString('string', $rules['label']);
        $this->assertStringContainsString('max:255', $rules['label']);
    }

    public function test_ingredient_request_validation_passes_with_valid_data()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        $data = [
            'label' => 'Tomate',
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'max_quantity' => 1000,
            'quantity' => 500,
            'balance_id' => null,
        ];
        
        $validator = Validator::make($data, (new IngredientRequest())->rules());
        
        $this->assertTrue($validator->passes());
    }

    public function test_ingredient_request_validation_fails_without_required_fields()
    {
        $data = [
            'label' => '',
            'type_id' => '',
            'measure_id' => '',
            'max_quantity' => '',
        ];
        
        $validator = Validator::make($data, (new IngredientRequest())->rules());
        
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('label'));
        $this->assertTrue($validator->errors()->has('type_id'));
        $this->assertTrue($validator->errors()->has('measure_id'));
        $this->assertTrue($validator->errors()->has('max_quantity'));
    }

    public function test_ingredient_request_validation_fails_with_invalid_type_id()
    {
        $measure = Measure::factory()->create();
        
        $data = [
            'label' => 'Tomate',
            'type_id' => 99999, // ID inexistant
            'measure_id' => $measure->id,
            'max_quantity' => 1000,
        ];
        
        $validator = Validator::make($data, (new IngredientRequest())->rules());
        
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('type_id'));
    }

    public function test_ingredient_request_validation_fails_with_invalid_measure_id()
    {
        $type = Type::factory()->create();
        
        $data = [
            'label' => 'Tomate',
            'type_id' => $type->id,
            'measure_id' => 99999, // ID inexistant
            'max_quantity' => 1000,
        ];
        
        $validator = Validator::make($data, (new IngredientRequest())->rules());
        
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('measure_id'));
    }

    public function test_ingredient_request_validation_fails_with_negative_quantity()
    {
        $type = Type::factory()->create();
        $measure = Measure::factory()->create();
        
        $data = [
            'label' => 'Tomate',
            'type_id' => $type->id,
            'measure_id' => $measure->id,
            'max_quantity' => -100,
            'quantity' => -50,
        ];
        
        $validator = Validator::make($data, (new IngredientRequest())->rules());
        
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('max_quantity'));
        $this->assertTrue($validator->errors()->has('quantity'));
    }

    public function test_ingredient_request_custom_error_messages()
    {
        $request = new IngredientRequest();
        $messages = $request->messages();
        
        $this->assertArrayHasKey('label.required', $messages);
        $this->assertArrayHasKey('type_id.required', $messages);
        $this->assertArrayHasKey('type_id.exists', $messages);
        $this->assertArrayHasKey('max_quantity.required', $messages);
        $this->assertArrayHasKey('measure_id.required', $messages);
        $this->assertArrayHasKey('measure_id.exists', $messages);
        
        $this->assertEquals('Le nom de l\'ingrédient est obligatoire', $messages['label.required']);
        $this->assertEquals('Le type de stockage est obligatoire', $messages['type_id.required']);
    }
}
