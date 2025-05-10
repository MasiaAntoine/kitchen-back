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
            'balance_id' => 'nullable|string|max:255',
            'type_id' => 'required|exists:types,id',
            'quantity' => 'numeric|min:0',
            'max_quantity' => 'required|numeric|min:0',
            'measure_id' => 'required|exists:measures,id',
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
            'type_id.required' => 'Le type de stockage est obligatoire',
            'type_id.exists' => 'Le type de stockage sélectionné est invalide',
            'max_quantity.required' => 'La quantité maximale est obligatoire',
            'measure_id.required' => 'L\'unité de mesure est obligatoire',
            'measure_id.exists' => 'L\'unité de mesure sélectionnée est invalide',
        ];
    }
}
