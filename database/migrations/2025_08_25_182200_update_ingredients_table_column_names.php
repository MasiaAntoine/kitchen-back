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
        Schema::table('ingredients', function (Blueprint $table) {
            $table->renameColumn('type_id', 'place_type_id');
            $table->renameColumn('measure_id', 'measurement_unit_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->renameColumn('place_type_id', 'type_id');
            $table->renameColumn('measurement_unit_id', 'measure_id');
        });
    }
};
