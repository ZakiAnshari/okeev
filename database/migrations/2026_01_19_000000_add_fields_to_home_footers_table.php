<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_footers', function (Blueprint $table) {
            if (!Schema::hasColumn('home_footers', 'description')) {
                $table->text('description')->nullable()->after('id');
            }
            if (!Schema::hasColumn('home_footers', 'email')) {
                $table->string('email')->nullable()->after('description');
            }
            if (!Schema::hasColumn('home_footers', 'handphone')) {
                $table->string('handphone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('home_footers', 'lokasi')) {
                $table->string('lokasi')->nullable()->after('handphone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('home_footers', function (Blueprint $table) {
            $table->dropColumn(['description','email','handphone','lokasi']);
        });
    }
};
