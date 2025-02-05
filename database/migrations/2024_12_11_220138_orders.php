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
                // Migration for Orders Table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('portal_id')->nullable();
            $table->unsignedBigInteger('handler_id')->nullable();
            $table->string('status')->default('pending');
            $table->decimal('total_price', 10, 2);
            $table->text('shipping_address');
            $table->string('payment_method');
            $table->tinyInteger('created_by')->default(0)->comment('0 = Customer, 1 = Vendor, 2 = Admin');
            $table->tinyInteger('order_type')->default(0)->comment('0 =affliate, 1 = Vendor setup');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('portal_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('handler_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variation_id');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('variation_id')->references('id')->on('variations')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
