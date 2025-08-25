<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ce seeder ne s'exécute que sur SQLite pour les tests
        if (config('database.default') !== 'sqlite') {
            return;
        }

        // Créer la table connected_scales si elle n'existe pas
        if (!Schema::hasTable('connected_scales')) {
            Schema::create('connected_scales', function (Blueprint $table) {
                $table->id();
                $table->string('mac_address')->unique();
                $table->timestamp('last_update')->nullable();
                $table->string('name')->nullable();
                $table->timestamps();
            });
        }

        // Ajouter la colonne connected_scale_id à ingredients si elle n'existe pas
        if (Schema::hasTable('ingredients') && !Schema::hasColumn('ingredients', 'connected_scale_id')) {
            Schema::table('ingredients', function (Blueprint $table) {
                $table->foreignId('connected_scale_id')->nullable()->constrained('connected_scales')->onDelete('set null');
            });
        }
    }
}
