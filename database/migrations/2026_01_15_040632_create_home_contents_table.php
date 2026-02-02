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
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();

            // ===== FIRST SECTION (ABOUT US) =====
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();

            // ===== SECOND SECTION (WHY CHOOSE US) =====
            $table->string('why_title_1')->nullable();
            $table->text('why_description_1')->nullable();

            $table->string('why_title_2')->nullable();
            $table->text('why_description_2')->nullable();

            $table->string('why_title_3')->nullable();
            $table->text('why_description_3')->nullable();

            // ===== THIRD SECTION (COLLABORATION) =====
            $table->string('collaboration_customer')->nullable();
            $table->string('collaboration_customer_happy')->nullable();

            // ===== STATUS =====
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_contents');
    }
};
