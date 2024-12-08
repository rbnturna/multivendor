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
            $table->string('name'); // Product name
            $table->string('slug')->unique(); // SEO-friendly URL identifier
            $table->string('sku')->nullable(); // Stock Keeping Unit (SKU)
            $table->string('image'); // Main image URL or path
            $table->json('gallery_images')->nullable(); // Gallery images (JSON format for multiple URLs)
            $table->decimal('price', 10, 2); // Original price
            $table->decimal('selling_price', 10, 2)->nullable(); // Discounted/selling price
            $table->text('description')->nullable(); // Detailed description
            $table->text('short_description')->nullable(); // Short description
            $table->unsignedInteger('stock')->nullable(); // Stock quantity
            $table->boolean('is_active')->default(true); // Active/inactive status
            $table->boolean('is_featured')->default(false); // Featured product flag
            $table->string('brand')->nullable(); // Brand name
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key for category
            $table->unsignedBigInteger('vendor_id')->nullable(); // Foreign key for vendor
            $table->decimal('tax', 8, 2)->default(0.00); // Tax percentage
            $table->decimal('weight', 8, 2)->nullable(); // Product weight (in kg)
            $table->decimal('length', 8, 2)->nullable(); // Length (in cm)
            $table->decimal('width', 8, 2)->nullable(); // Width (in cm)
            $table->decimal('height', 8, 2)->nullable(); // Height (in cm)
            $table->unsignedInteger('views')->default(0); // Number of views
            $table->decimal('rating', 3, 2)->default(0.0); // Average rating
            $table->unsignedInteger('total_reviews')->default(0); // Total number of reviews
            $table->unsignedInteger('sold')->default(0); // Total sold quantity
            $table->timestamp('available_from')->nullable(); // Available from date
            $table->timestamp('available_until')->nullable(); // Available until date
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes(); 
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
