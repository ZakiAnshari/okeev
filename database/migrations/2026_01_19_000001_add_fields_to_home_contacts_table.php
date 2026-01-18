<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('home_contacts', 'description')) {
                $table->text('description')->nullable()->after('id');
            }
            if (!Schema::hasColumn('home_contacts', 'instagram')) {
                $table->string('instagram')->nullable()->after('description');
            }
            if (!Schema::hasColumn('home_contacts', 'tiktok')) {
                $table->string('tiktok')->nullable()->after('instagram');
            }
            if (!Schema::hasColumn('home_contacts', 'x')) {
                $table->string('x')->nullable()->after('tiktok');
            }
        });
    }

    public function down(): void
    {
        Schema::table('home_contacts', function (Blueprint $table) {
            $table->dropColumn(['description','instagram','tiktok','x']);
        });
    }
};
