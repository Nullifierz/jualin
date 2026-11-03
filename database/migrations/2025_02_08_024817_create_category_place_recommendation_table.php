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
        Schema::create('category_place_recommendation', function (Blueprint $table) {
            $table->foreignId('id_recommendation')->constrained('place_recommendations', 'id_recommendation')->onDelete('cascade');
            $table->foreignId('id_category')->constrained('categories', 'id_category')->onDelete('cascade');

            $table->primary(['id_recommendation', 'id_category']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_place_recommendation');
    }
};
