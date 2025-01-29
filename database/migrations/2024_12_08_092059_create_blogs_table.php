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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Product name
            $table->string('slug')->unique(); // SEO-friendly URL identifier
            $table->string('image'); // Main image URL or path
            $table->text('description')->nullable(); // Detailed description
            $table->text('short_description')->nullable(); // Short description
            $table->boolean('is_active')->default(true); // Active/inactive status
            $table->unsignedBigInteger('vendor_id')->nullable(); // Foreign key for vendor
            $table->unsignedInteger('views')->default(0); // Number of views
            $table->timestamps(); 
        });

    

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
       
    }
};
