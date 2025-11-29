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

            // CATEGORY
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // BRAND
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->string('model_name');
            $table->string('slug')->nullable();
            $table->integer('miles')->nullable();
            $table->integer('seats')->nullable();
            // PRICES
            $table->bigInteger('price');
            // INVENTORY
            $table->enum('stock_status', ['in_stock', 'out_of_stock'])->default('in_stock');
            $table->text('description')->nullable();
            // FLAGS
            $table->boolean('featured')->default(false);
            
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
