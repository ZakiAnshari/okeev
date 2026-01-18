<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_abouts', function (Blueprint $table) {
            if (! Schema::hasColumn('home_abouts', 'visi_image')) {
                $table->string('visi_image')->nullable()->after('visi_description');
            }
            if (! Schema::hasColumn('home_abouts', 'misi_image')) {
                $table->string('misi_image')->nullable()->after('visi_image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('home_abouts', function (Blueprint $table) {
            $table->dropColumn(['visi_image','misi_image']);
        });
    }
};
