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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('subtitle')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('volume')->nullable(); // e.g., "50ml", "100ml"
            $table->string('image')->nullable(); // main product image
            $table->json('images')->nullable(); // gallery images
            $table->json('colors')->nullable(); // color swatches (JSON array of hex codes)
            $table->string('category')->nullable(); // e.g., "Fragrance"
            $table->text('top_notes')->nullable(); // scent notes
            $table->text('heart_notes')->nullable();
            $table->text('base_notes')->nullable();
            $table->text('ingredients')->nullable();
            $table->text('care_instructions')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('in_stock')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
