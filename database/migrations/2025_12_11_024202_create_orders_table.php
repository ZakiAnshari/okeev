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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');

            $table->string('external_id');
            $table->string('no_transaction');
            $table->string('model_name');
            $table->string('color');
            $table->string('invoice_url');

            $table->integer('qty');
            $table->decimal('price', 15, 2);
            $table->bigInteger('grand_total');

            $table->string('status')->default('pending');
            $table->timestamps();

            // FK user
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // FK product
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
