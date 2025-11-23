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

            // MAIN INFO
            $table->string('brand')->nullable();
            $table->string('model_name');
            $table->string('category');
            $table->string('slug')->nullable();
            $table->integer('miles')->nullable();
            $table->enum('type', ['electric', 'hybrid', 'fuel'])->default('Electric');
            $table->integer('seats')->nullable();
            $table->string('cc')->nullable();

            // PRICES
            $table->bigInteger('regular_price')->nullable();
            $table->bigInteger('sale_price')->nullable();

            // INVENTORY
            $table->integer('quantity')->default(0);
            $table->enum('stock_status', ['in_stock', 'out_of_stock'])
                ->default('in_stock');

            // FLAGS
            $table->boolean('featured')->default(false);

            // IMAGES
            $table->string('image_wallpaper');       // front wallpaper image
            $table->string('image');                 // main product image
            // DETAIL IMAGES
            $table->string('image_detail_1');
            $table->string('image_detail_2');
            $table->string('image_detail_3');

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
