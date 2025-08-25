<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Changé à true pour autoriser les requêtes
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'label' => 'required|string|max:255',
            'connected_scale_id' => 'nullable|integer|exists:connected_scales,id',
            'place_type_id' => 'required|exists:place_types,id',
            'quantity' => 'numeric|min:0',
            'max_quantity' => 'required|numeric|min:0',
            'measurement_unit_id' => 'required|exists:measurement_units,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'label.required' => 'Le nom de l\'ingrédient est obligatoire',
            'place_type_id.required' => 'Le type de lieu est obligatoire',
            'place_type_id.exists' => 'Le type de lieu sélectionné est invalide',
            'max_quantity.required' => 'La quantité maximale est obligatoire',
            'measurement_unit_id.required' => 'L\'unité de mesure est obligatoire',
            'measurement_unit_id.exists' => 'L\'unité de mesure sélectionnée est invalide',
        ];
    }
}
