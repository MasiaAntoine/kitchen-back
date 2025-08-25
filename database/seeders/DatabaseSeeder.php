<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Ingredient;
use App\Models\PlaceType;
use App\Models\MeasurementUnit;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Désactiver temporairement les contraintes de clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Vider les tables dans l'ordre inverse des dépendances
        Ingredient::truncate();
        PlaceType::truncate();
        MeasurementUnit::truncate();

        // Réactiver les contraintes de clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // L'ordre des seeders est important
        $this->call([
            PlaceTypeSeeder::class,           // D'abord les types de lieux
            MeasurementUnitSeeder::class,     // Ensuite les unités de mesure
            ConnectedScaleSeeder::class,      // Puis les balances connectées
            IngredientSeeder::class,          // Enfin les ingrédients qui dépendent des autres
        ]);

        // Ajouter le seeder de test pour SQLite
        if (config('database.default') === 'sqlite') {
            $this->call(TestDatabaseSeeder::class);
        }
    }
}
