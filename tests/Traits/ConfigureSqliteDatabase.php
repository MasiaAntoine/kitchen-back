<?php

namespace Tests\Traits;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

trait ConfigureSqliteDatabase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Configuration spécifique pour SQLite
        if (config('database.default') === 'sqlite') {
            $this->configureSqliteForTests();
        }
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
        if (Schema::hasTable('ingredients') && !Schema::hasColumn('ingredients', 'connected_scale_id')) {
            Schema::table('ingredients', function ($table) {
                $table->foreignId('connected_scale_id')->nullable()->constrained('connected_scales')->onDelete('set null');
            });
        }
    }
}
