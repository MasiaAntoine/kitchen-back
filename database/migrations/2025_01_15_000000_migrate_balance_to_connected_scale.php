<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cette migration s'exécute sur MySQL et SQLite (pour les tests)
        if (config('database.default') === 'sqlite') {
            // Pour SQLite, créer seulement les tables nécessaires
            if (!Schema::hasTable('connected_scales')) {
                Schema::create('connected_scales', function (Blueprint $table) {
                    $table->id();
                    $table->string('mac_address')->unique();
                    $table->timestamp('last_update')->nullable();
                    $table->string('name')->nullable();
                    $table->timestamps();
                });
            }
            
            if (Schema::hasTable('ingredients') && !Schema::hasColumn('ingredients', 'connected_scale_id')) {
                Schema::table('ingredients', function (Blueprint $table) {
                    $table->foreignId('connected_scale_id')->nullable()->constrained('connected_scales')->onDelete('set null');
                });
            }
            return;
        }

        // 1. Créer la nouvelle table connected_scales si elle n'existe pas
        if (!Schema::hasTable('connected_scales')) {
            Schema::create('connected_scales', function (Blueprint $table) {
                $table->id();
                $table->string('mac_address')->unique();
                $table->timestamp('last_update')->nullable();
                $table->string('name')->nullable();
                $table->timestamps();
            });
        }

        // 2. Ajouter la colonne connected_scale_id à ingredients si elle n'existe pas
        if (!Schema::hasColumn('ingredients', 'connected_scale_id')) {
            Schema::table('ingredients', function (Blueprint $table) {
                $table->foreignId('connected_scale_id')->nullable()->constrained('connected_scales')->onDelete('set null');
            });
        }

        // 3. Migrer les données si la table balances existe
        if (Schema::hasTable('balances')) {
            // Vérifier s'il y a déjà des données dans connected_scales
            $existingCount = DB::table('connected_scales')->count();
            if ($existingCount == 0) {
                // Copier les données de balances vers connected_scales
                DB::statement('INSERT INTO connected_scales (id, mac_address, last_update, name, created_at, updated_at) SELECT id, mac_address, last_update, name, created_at, updated_at FROM balances');
            }
            
            // Mettre à jour les références dans ingredients si balance_id existe
            if (Schema::hasColumn('ingredients', 'balance_id')) {
                DB::statement('UPDATE ingredients SET connected_scale_id = balance_id WHERE balance_id IS NOT NULL');
                
                // Supprimer d'abord la contrainte de clé étrangère
                Schema::table('ingredients', function (Blueprint $table) {
                    $table->dropForeign(['balance_id']);
                });
                
                // Puis supprimer la colonne balance_id
                Schema::table('ingredients', function (Blueprint $table) {
                    $table->dropColumn('balance_id');
                });
            }
            
            // Supprimer l'ancienne table balances
            Schema::dropIfExists('balances');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Créer la table balances
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->string('mac_address')->unique();
            $table->timestamp('last_update')->nullable();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // 2. Ajouter la colonne balance_id à ingredients
        Schema::table('ingredients', function (Blueprint $table) {
            $table->foreignId('balance_id')->nullable()->constrained('balances')->onDelete('set null');
        });

        // 3. Restaurer les données
        DB::statement('INSERT INTO balances (id, mac_address, last_update, name, created_at, updated_at) SELECT id, mac_address, last_update, name, created_at, updated_at FROM connected_scales');
        
        DB::statement('UPDATE ingredients SET balance_id = connected_scale_id WHERE connected_scale_id IS NOT NULL');
        
        // 4. Supprimer la nouvelle colonne et table
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropForeign(['connected_scale_id']);
            $table->dropColumn('connected_scale_id');
        });
        
        Schema::dropIfExists('connected_scales');
    }
};
