<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\PlaceType;
use App\Models\MeasurementUnit;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupération des IDs nécessaires
        $placard = PlaceType::where('name', 'Placard')->first()->id;
        $frigo = PlaceType::where('name', 'Frigo')->first()->id;
        $congelateur = PlaceType::where('name', 'Congélateur')->first()->id;

        // Récupération des unités de mesure
        $g = MeasurementUnit::where('symbol', 'g')->first()->id;
        $ml = MeasurementUnit::where('symbol', 'ml')->first()->id;
        $pc = MeasurementUnit::where('symbol', 'pc')->first()->id;

        $quantity = 0;

        // Création des ingrédients
        $ingredients = [
            [
                'label' => 'farine',
                'place_place_type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 1000,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'sucre',
                'place_place_type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 1000,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'pain burger',
                'place_type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 8,
                'measurement_unit_id' => $pc,
            ],
            [
                'label' => 'huile tournesol',
                'place_type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 2000,
                'measurement_unit_id' => $ml,
            ],
            [
                'label' => 'pain de mie',
                'place_type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 500,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'riz',
                'place_type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 2000,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'pâtes lasagne',
                'place_type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 500,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'spaghetti',
                'place_type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 2000,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'pâtes fusilli N°48',
                'place_type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 2000,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'sauce tomate',
                'place_type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 2000,
                'measurement_unit_id' => $g,
            ],

            [
                'label' => 'pizza surgelée',
                'place_type_id' => $congelateur,
                'quantity' => $quantity,
                'max_quantity' => 2,
                'measurement_unit_id' => $pc,
            ],
            [
                'label' => 'nuggets de poulet',
                'place_type_id' => $congelateur,
                'quantity' => $quantity,
                'max_quantity' => 1000,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'steak haché',
                'place_type_id' => $congelateur,
                'quantity' => $quantity,
                'max_quantity' => 1000,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'poulet',
                'place_type_id' => $congelateur,
                'quantity' => $quantity,
                'max_quantity' => 1000,
                'measurement_unit_id' => $g,
            ],


            [
                'label' => 'oeufs',
                'place_type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 6,
                'measurement_unit_id' => $pc,
            ],
            [
                'label' => 'beurre',
                'place_type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 500,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'bacon fumé',
                'place_type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 600,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'cheddar',
                'place_type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 400,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'frommage à croque monsieur',
                'place_type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 400,
                'measurement_unit_id' => $g,
            ],
            [
                'label' => 'crème fraîche',
                'place_type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 500,
                'measurement_unit_id' => $ml,
            ],
            [
                'label' => 'reblochon',
                'place_type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 450,
                'measurement_unit_id' => $g,
            ],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }
    }
}
