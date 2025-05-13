<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Measure;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupération des IDs nécessaires
        $placard = Type::where('name', 'Placard')->first()->id;
        $frigo = Type::where('name', 'Frigo')->first()->id;
        $congelateur = Type::where('name', 'Congélateur')->first()->id;

        // Récupération des unités de mesure
        $g = Measure::where('symbol', 'g')->first()->id;
        $ml = Measure::where('symbol', 'ml')->first()->id;
        $pc = Measure::where('symbol', 'pc')->first()->id;

        $quantity = 0;

        // Création des ingrédients
        $ingredients = [
            [
                'label' => 'farine',
                'type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 1000,
                'measure_id' => $g,
            ],
            [
                'label' => 'sucre',
                'type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 1000,
                'measure_id' => $g,
            ],
            [
                'label' => 'pain burger',
                'type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 8,
                'measure_id' => $pc,
            ],
            [
                'label' => 'huile tournesol',
                'type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 2000,
                'measure_id' => $ml,
            ],
            [
                'label' => 'pain de mie',
                'type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 500,
                'measure_id' => $g,
            ],
            [
                'label' => 'riz',
                'type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 2000,
                'measure_id' => $g,
            ],
            [
                'label' => 'pâtes lasagne',
                'type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 500,
                'measure_id' => $g,
            ],
            [
                'label' => 'spaghetti',
                'type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 2000,
                'measure_id' => $g,
            ],
            [
                'label' => 'pâtes fusilli N°48',
                'type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 2000,
                'measure_id' => $g,
            ],
            [
                'label' => 'sauce tomate',
                'type_id' => $placard,
                'quantity' => $quantity,
                'max_quantity' => 2000,
                'measure_id' => $g,
            ],

            [
                'label' => 'pizza surgelée',
                'type_id' => $congelateur,
                'quantity' => $quantity,
                'max_quantity' => 2,
                'measure_id' => $pc,
            ],
            [
                'label' => 'nuggets de poulet',
                'type_id' => $congelateur,
                'quantity' => $quantity,
                'max_quantity' => 1000,
                'measure_id' => $g,
            ],
            [
                'label' => 'steak haché',
                'type_id' => $congelateur,
                'quantity' => $quantity,
                'max_quantity' => 1000,
                'measure_id' => $g,
            ],
            [
                'label' => 'poulet',
                'type_id' => $congelateur,
                'quantity' => $quantity,
                'max_quantity' => 1000,
                'measure_id' => $g,
            ],


            [
                'label' => 'oeufs',
                'type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 6,
                'measure_id' => $pc,
            ],
            [
                'label' => 'beurre',
                'type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 500,
                'measure_id' => $g,
            ],
            [
                'label' => 'bacon fumé',
                'type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 600,
                'measure_id' => $g,
            ],
            [
                'label' => 'cheddar',
                'type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 400,
                'measure_id' => $g,
            ],
            [
                'label' => 'frommage à croque monsieur',
                'type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 400,
                'measure_id' => $g,
            ],
            [
                'label' => 'crème fraîche',
                'type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 500,
                'measure_id' => $ml,
            ],
            [
                'label' => 'reblochon',
                'type_id' => $frigo,
                'quantity' => $quantity,
                'max_quantity' => 450,
                'measure_id' => $g,
            ],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }
    }
}
