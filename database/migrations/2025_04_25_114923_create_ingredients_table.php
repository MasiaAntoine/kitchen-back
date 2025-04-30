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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->boolean('is_connected')->default(false);
            $table->foreignId('type_id')->constrained();
            $table->decimal('quantity', 8, 2)->default(0);
            $table->decimal('max_quantity', 8, 2);
            $table->foreignId('measure_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
