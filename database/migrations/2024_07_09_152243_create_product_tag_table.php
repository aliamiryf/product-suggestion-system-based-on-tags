<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_tag', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key to products table
            $table->foreignId('tag_id')->constrained()->onDelete('cascade'); // Foreign key to tags table
            $table->timestamps(); // Created at and updated at timestamps

            // Additional indexes for better performance
            $table->index(['product_id', 'tag_id']); // Composite index for faster querying
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_tag');
    }
};
