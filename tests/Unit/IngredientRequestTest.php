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
        $this->assertArrayHasKey('place_type_id', $rules);
        $this->assertArrayHasKey('measurement_unit_id', $rules);
        $this->assertArrayHasKey('max_quantity', $rules);
        $this->assertArrayHasKey('quantity', $rules);
        $this->assertArrayHasKey('connected_scale_id', $rules);
        
        $this->assertStringContainsString('required', $rules['label']);
        $this->assertStringContainsString('string', $rules['label']);
        $this->assertStringContainsString('max:255', $rules['label']);
    }

    public function test_ingredient_request_validation_passes_with_valid_data()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $data = [
            'label' => 'Tomate',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
            'max_quantity' => 1000,
            'quantity' => 500,
            'connected_scale_id' => null,
        ];
        
        $validator = Validator::make($data, (new IngredientRequest())->rules());
        
        $this->assertTrue($validator->passes());
    }

    public function test_ingredient_request_validation_fails_without_required_fields()
    {
        $data = [
            'label' => '',
            'place_type_id' => '',
            'measurement_unit_id' => '',
            'max_quantity' => '',
        ];
        
        $validator = Validator::make($data, (new IngredientRequest())->rules());
        
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('label'));
        $this->assertTrue($validator->errors()->has('place_type_id'));
        $this->assertTrue($validator->errors()->has('measurement_unit_id'));
        $this->assertTrue($validator->errors()->has('max_quantity'));
    }

    public function test_ingredient_request_validation_fails_with_invalid_place_type_id()
    {
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $data = [
            'label' => 'Tomate',
            'place_type_id' => 99999, // ID inexistant
            'measurement_unit_id' => $measurementUnit->id,
            'max_quantity' => 1000,
        ];
        
        $validator = Validator::make($data, (new IngredientRequest())->rules());
        
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('place_type_id'));
    }

    public function test_ingredient_request_validation_fails_with_invalid_measurement_unit_id()
    {
        $placeType = PlaceType::factory()->create();
        
        $data = [
            'label' => 'Tomate',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => 99999, // ID inexistant
            'max_quantity' => 1000,
        ];
        
        $validator = Validator::make($data, (new IngredientRequest())->rules());
        
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('measurement_unit_id'));
    }

    public function test_ingredient_request_validation_fails_with_negative_quantity()
    {
        $placeType = PlaceType::factory()->create();
        $measurementUnit = MeasurementUnit::factory()->create();
        
        $data = [
            'label' => 'Tomate',
            'place_type_id' => $placeType->id,
            'measurement_unit_id' => $measurementUnit->id,
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
        $this->assertArrayHasKey('place_type_id.required', $messages);
        $this->assertArrayHasKey('place_type_id.exists', $messages);
        $this->assertArrayHasKey('max_quantity.required', $messages);
        $this->assertArrayHasKey('measurement_unit_id.required', $messages);
        $this->assertArrayHasKey('measurement_unit_id.exists', $messages);
        
        $this->assertEquals('Le nom de l\'ingrédient est obligatoire', $messages['label.required']);
        $this->assertEquals('Le type de stockage est obligatoire', $messages['place_type_id.required']);
    }
}
